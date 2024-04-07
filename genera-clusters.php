<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once('include.php');
    include_once('function-bayes.php');

    $conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die ("Impossibile trovare host di destinazione. Contattare l'assistenza tecnica.");

    $rec_utenti = sql2ar("SELECT DISTINCT id_user FROM intai_session_data WHERE fbp != '' ");
    $rec_nomi_cluster = sql2ar("SELECT * FROM intai_cluster_map WHERE stato='1' ");
    $cluster_map = [];
    $user_map = [];

    foreach($rec_nomi_cluster as $single_cluster)
    {
        $cluster_map[$single_cluster['ID']] = $single_cluster['nome_cluster'];
    }

    $i = 0;

    $samples = [];

    foreach($rec_utenti as $row)
    {
        //$user_map[$row['id_user']] = [ "fbc" => $row['fbc'],  "fbp" => $row['fbp'],  "client_ip_address" => $row['client_ip_address'], "client_user_agent" => $row['client_user_agent']   ];
        //usr_s8h4m1c28
        $rec_sessioni_interessanti_utente = sql2ar("SELECT * FROM intai_tracking_data WHERE id_user='$row[id_user]' AND id_section < 44 AND id_section > 33");

        $item_cluster = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach($rec_sessioni_interessanti_utente as $row_track)
        {
            $index_item = $row_track['id_section'] - 34; //shifto così che il primo parametro equivale al primo indice dell'array
            if($row_track['type'] == "view" )
            {
                $item_cluster[$index_item] = $item_cluster[$index_item] + $row_track['time_spent'];
            }
            else //se è un click aggiungo un quantitativo fisso (10 s)
            {
                $item_cluster[$index_item] = $item_cluster[$index_item] + 10000;
            }
            
        }
        
        $samples[] = ["$row[id_user]" , $item_cluster];

        $i++;
    }

    echo "<pre> SAMPLES <br><br><hr>";
    print_r($samples);
    echo "<hr></pre>";

    $array_name_clusters = [
        1 => 'siti-web',
        2 => 'e-commerce',
        3 => 'smm',
        4 => 'campagne',
        5 => 'software',
        6 => 'mkt',
        7 => 'shooting',
        8 => 'formazione',
        9 => 'ai-mkt',
        10 => 'ai-algoritmi'
    ];
    


    /**
     * 
     * [900, 600, 150];
     * 
     * ALGORITMO DI CLASSIFICAZIONE
     * 
     * Prendo il massimo tempo tra le varie dimensioni
     * Imposto una soglia al 50% sul massimo
     * Per ogni misurazione che supera la soglia, viene assegnata la relativa classe
     * 
    */

    $stamp_send_data = "";

    foreach($samples as $key_sample => $single_sample) 
    {

        $rec_last_info_utente = sql2val("SELECT * FROM intai_session_data WHERE id_user='$single_sample[0]' AND fbp != '' ORDER BY start_time DESC LIMIT 1");

        $max_val = max($single_sample[1]);
        $threshold = $max_val / 2;

        $classes_sample = [];
        $string_classes = "";
        $string_classes_from_chat = "";

        foreach($single_sample[1] as $key_num => $num)
        {
            if($num > $threshold)
            {
                $id_cluster_sing = $key_num+1;
                $classes_sample[] = $id_cluster_sing; //così che i numeri equivalgono agli id su DB
                $string_classes .= "". $id_cluster_sing .'|';


                //CLUSTER DI PROVA --> TEST_

                // $stamp_send_data .= "
                //     sendData({ 
                //         nome_cluster: 'TEST_$cluster_map[$id_cluster_sing]', 
                //         id_user: '$single_sample[0]', 
                //         fbc: '$rec_last_info_utente[fbc]', 
                //         fbp: '$rec_last_info_utente[fbp]',
                //         client_ip_address: '$rec_last_info_utente[client_ip_address]',
                //         client_user_agent: '$rec_last_info_utente[client_user_agent]'
                //     })
                // ";

                $stamp_send_data .= "
                    sendData({ 
                        nome_cluster: 'PROD1_$cluster_map[$id_cluster_sing]', 
                        id_user: '$single_sample[0]', 
                        fbc: '$rec_last_info_utente[fbc]', 
                        fbp: '$rec_last_info_utente[fbp]',
                        client_ip_address: '$rec_last_info_utente[client_ip_address]',
                        client_user_agent: '$rec_last_info_utente[client_user_agent]'
                    })
                ";
            }
        }


        //ANALIZZO LE CHAT CON L'AI
        $rec_chat_session_user = sql2ar("SELECT * FROM intai_chat_storage INNER JOIN intai_session_data ON intai_chat_storage.id_session = intai_session_data.id_session WHERE id_user='$single_sample[0]' ");
        $all_chats = "";
        foreach($rec_chat_session_user as $row)
        {
            //unisco tutte le chat in un unico testo - prendo solo i messaggi dell'utente
            if($row['ruolo_chat'] == 2)
            {
                $all_chats .= $row['msg'];
            }
            else
            {
                continue;
            }
        }

        if($all_chats != "")
        {
            $class_from_chat = cluster_bayes($all_chats, $classifier_master);

            $id_cluster_sing_chat = array_search($class_from_chat, $array_name_clusters);

            $string_classes_from_chat .= "". $id_cluster_sing_chat .'|';

            //CLUSTER DI PROVA --> TEST_
            //CLUSTER DALLA CHAT --> TEST_CHAT_
            // $stamp_send_data .= "
            //     sendData({ 
            //         nome_cluster: 'TEST_CHAT_$class_from_chat', 
            //         id_user: '$single_sample[0]', 
            //         fbc: '$rec_last_info_utente[fbc]', 
            //         fbp: '$rec_last_info_utente[fbp]',
            //         client_ip_address: '$rec_last_info_utente[client_ip_address]',
            //         client_user_agent: '$rec_last_info_utente[client_user_agent]'
            //     })
            // ";

            $stamp_send_data .= "
                sendData({ 
                    nome_cluster: 'PROD1_CHAT_$class_from_chat', 
                    id_user: '$single_sample[0]', 
                    fbc: '$rec_last_info_utente[fbc]', 
                    fbp: '$rec_last_info_utente[fbp]',
                    client_ip_address: '$rec_last_info_utente[client_ip_address]',
                    client_user_agent: '$rec_last_info_utente[client_user_agent]'
                })
            ";
        }


        $string_classes = substr($string_classes, 0, -1); //tolgo l'ultima |
        $string_classes_from_chat = substr($string_classes_from_chat, 0, -1); //tolgo l'ultima |
        $samples[$key_sample][] = $classes_sample;


        //Update dei cluster su DB - INTERAZIONE
        if($string_classes != "")
        {
            $rec_clusters = sql2val("SELECT * FROM intai_users_clustered WHERE id_user='$single_sample[0]' AND tipo_cluster='0' AND stato='1' ");
            if($rec_clusters != NULL || $rec_clusters != false)
            {
                //aggiorno
                do_query("UPDATE intai_users_clustered SET id_cluster='$string_classes' WHERE id_user='$single_sample[0]' AND tipo_cluster='0' ");
            }
            else
            {
                //inserisco
                do_query("INSERT INTO intai_users_clustered (id_user, id_cluster, tipo_cluster, stato) VALUES ('$single_sample[0]', '$string_classes', '0', 1)");
            }
        }

        //Update dei cluster su DB - CHAT
        if($string_classes_from_chat != "")
        {
            $rec_clusters = sql2val("SELECT * FROM intai_users_clustered WHERE id_user='$single_sample[0]' AND tipo_cluster='1' AND stato='1' ");
            if($rec_clusters != NULL || $rec_clusters != false)
            {
                //aggiorno
                do_query("UPDATE intai_users_clustered SET id_cluster='$string_classes_from_chat' WHERE id_user='$single_sample[0]' AND tipo_cluster='1' ");
            }
            else
            {
                //inserisco
                do_query("INSERT INTO intai_users_clustered (id_user, id_cluster, tipo_cluster, stato) VALUES ('$single_sample[0]', '$string_classes_from_chat', '1', 1)");
            }
        }
        

    }

    // echo "<pre>";
    // echo "<h2>Ris</h2> <br>";
    // print_r($samples);
    // echo "</pre>";



    mysqli_close($conn);

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script>

    function sendData(data) {

        $.ajax({
            type: 'POST',
            url: '/fb-custom-audience-api.php', 
            data: JSON.stringify(data),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(response) {
                console.log('[Success]:', response);
            },
            error: function(error) {
                console.error('[Error]:', error);
            }
        });
    }

    <?= $stamp_send_data ?>
    
</script>

<div>
    <pre>
        <?= $stamp_send_data ?>
    </pre>
</div>

