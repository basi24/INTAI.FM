<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    include('include.php');

    $conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die ("Impossibile trovare host di destinazione. Contattare l'assistenza tecnica.");

    require_once "mobilelibs/Mobile_Detect.php";
    $detect = new Mobile_Detect();

    $open_chat = $_GET['open_chat'];
    $open_chat_bool = false;
    if($open_chat == "open") {
        $open_chat_bool = 1;
    }
    else
    {
        $open_chat_bool = 0;
    }

    $clientIpAddress = $_SERVER['REMOTE_ADDR'];
    $clientUserAgent = $_SERVER['HTTP_USER_AGENT'];

    $array_title_serv = [
        "Siti Web Rivoluzionari",
        "Piattaforme E-Commerce Performanti",
        "Social Media Marketing per il Business",
        "Campagne Pubblicitarie Internazionali",
        "Software Gestionali Personalizzati",
        "Consulenze di Marketing Strategico",
        "Foto, Video, Testi e Shooting Social",
        "Formazione Quadri Aziendali per il Digitale"
    ];

    $array_txt1_serv = [
        "Siti web vetrina <br>
        Siti web aziendali <br>
        Siti web one-page <br>
        Siti web multilingue
        ",

        "Piattaforme E-Commerce B2C <br>
        Piattaforme E-Commerce B2B <br>
        Piattaforme E-Learning <br>
        Piattaforme E-Commerce per prodotti e servizi
        ",

        "Gestione profili social <br>
        Creazione contenuti di alta qualità <br>
        Pianificazione e programmazione post & blog <br>
        Pubblicità sui canali social (Facebook, Instagram, TikTok, LinkedIn, etc.) <br>
        Analisi e monitoraggio performance con report dettagliati
        ",

        "Strategia di marketing internazionale <br>
        Creazione contenuti in linea con le caratteristiche culturali e linguistiche internazionali <br>
        Gestione campagne pubblicitarie su piattaforme globali <br>
        Analisi e monitoraggio performance con report dettagliati
        ",

        "Analisi esigenze aziendali <br>
        Progettazione e sviluppo strumenti gestionali su misura <br>
        Integrazione con i sistemi aziendali esistenti <br>
        Formazione e supporto personale specialistico
        ",

        "Comunicazione marketing e pubblicità <br>
        Strategie di marketing e web marketing <br>
        Consulenze di marketing strategico e operativo <br>
        Piani di sviluppo vendite
        ",

        "Brand identity & Web identity <br>
        Creazione contenuti digitali di alta qualità <br>
        Shooting social foto e video <br>
        Creazione testi coinvolgenti <br>
        Foto editing e video editing
        ",

        "Corsi di formazione marketing digitale <br>
        Workshops personalizzati <br>
        Formazione agenti e reti di vendita <br>
        Coaching one-to-one per imprenditori e manager 
        "
    ];
    /*
        $array_txt2_serv = [
            "
                Immagina un abito su misura, perfettamente confezionato per esaltare i tuoi punti di forza e riflettere la tua personalità unica. Questo è esattamente ciò che Jam Web Division offre con il servizio di 'Siti web personalizzati'. 
                <br><br>
                Comprendiamo che ogni imprenditore e ogni azienda sono unici, con specifici obiettivi, valori e clientela. Per questo, non ci limitiamo a creare un semplice sito web, ma progettiamo una piattaforma digitale che rifletta la tua identità aziendale, parli la lingua dei tuoi clienti e valorizzi i tuoi prodotti o servizi nel modo più efficace.
                <br><br>
                Con un sito web personalizzato, hai l'opportunità di distinguerti dalla concorrenza, di offrire ai tuoi clienti un'esperienza online unica e di massimizzare le tue conversioni. Questo perché un sito web non è solo una vetrina, ma un potente strumento di comunicazione e vendita che può fare la differenza nel successo del tuo business.
                <br><br>
                Lavoriamo con te, ascoltiamo le tue idee, comprendiamo le tue esigenze e trasformiamo tutto questo in un sito web funzionale, intuitivo e visivamente accattivante, capace di catturare l'attenzione dei visitatori e guidarli verso l'azione che desideri, sia essa un acquisto, una prenotazione o la richiesta di un preventivo.
                <br><br>
                Con Jam Web Division al tuo fianco, il tuo sito web non sarà solo un dettaglio, ma il cuore pulsante della tua presenza online.
            ",

            "
                Nell'era digitale, l'e-commerce non è più un'opzione, ma una necessità. Ma non temere, con Jam Web Division al tuo fianco, la navigazione nel mondo dell'e-commerce diventa un viaggio emozionante piuttosto che un'impresa temibile.
                <br><br>
                Il nostro servizio 'Piattaforme E-Commerce offre un mondo di possibilità per i tuoi affari online. Pensaci: un negozio aperto 24 ore su 24, 7 giorni su 7, raggiungibile da chiunque, ovunque nel mondo. E non solo un negozio qualunque, ma uno progettato specificamente per te, che rispecchia la tua marca e risponde perfettamente alle esigenze dei tuoi clienti.
                <br><br>
                Dal design intuitivo alla navigazione fluida, dalle descrizioni dei prodotti convincenti alla sicurezza nei pagamenti, curiamo ogni dettaglio per assicurare un'esperienza di acquisto piacevole e senza intoppi per i tuoi clienti. E non è tutto: grazie alle soluzioni avanzate di gestione delle scorte e dei resi, non dovrai preoccuparti di nulla, se non di vedere le vendite aumentare!
                <br><br>
                Con Jam Web Division, l'e-commerce non è solo un canale di vendita in più, ma un potente motore di crescita per il tuo business. Mettiamo al tuo servizio la nostra esperienza, la nostra creatività e le tecnologie più avanzate per creare un e-commerce che ti permetta di raggiungere nuovi clienti, aumentare le vendite e fare il salto di qualità nel mondo digitale.
            ",

            "
                Immagina di avere una sala piena di potenziali clienti, tutti lì per ascoltare quello che hai da dire sulla tua azienda, sui tuoi prodotti o servizi. Ora, trasforma quella sala in un mondo, interconnesso e in continua crescita: ecco ciò che i social media possono fare per te. 
                <br><br>
                Il servizio 'Social Media Marketing' di Jam Web Division ti offre l'opportunità di connetterti con un pubblico globale, di costruire relazioni durature e di far conoscere la tua marca come mai prima d'ora. Ma non si tratta solo di essere presenti sui social media, si tratta di saperli utilizzare nel modo giusto.
                <br><br>
                Capiremo insieme quali sono le piattaforme più adatte a te, creeremo contenuti coinvolgenti e di valore, pianificheremo strategie di engagement che ti permetteranno di interagire con i tuoi follower in modo autentico e personale. Inoltre, grazie all'analisi dei dati, sapremo sempre quali sono i contenuti che funzionano meglio e come ottimizzare le tue campagne per ottenere il massimo ritorno sull'investimento.
                <br><br>
                Con Jam Web Division, i social media diventano un potente strumento al servizio del tuo business, capace di aumentare la visibilità della tua marca, di attirare nuovi clienti e di fidelizzare quelli esistenti. Lascia che ti guidiamo in questo viaggio emozionante nel mondo dei social media: ti promettiamo che sarà un'avventura che porterà grandi benefici al tuo business.
            ",

            "
                Penetrare nuovi mercati e raggiungere clienti in ogni angolo del mondo è il sogno di ogni imprenditore. Ma come si fa a far conoscere la propria azienda in un paese con una cultura, una lingua e delle abitudini di consumo differenti? La risposta sta nelle Campagne Pubblicitarie Internazionali.
                <br><br>
                Il servizio 'Campagne Pubblicitarie Internazionali' di Jam Web Division ti offre la possibilità di comunicare efficacemente con un pubblico globale, trasmettendo il tuo messaggio nel modo più appropriato per ciascun mercato. Non si tratta solo di tradurre il tuo messaggio in un'altra lingua, ma di adattarlo alla cultura e alle esigenze specifiche di ogni paese.
                <br><br>
                Noi di Jam Web Division non ci limitiamo a creare campagne pubblicitarie: ci immergiamo nel contesto culturale dei tuoi potenziali clienti per capire come parlare al loro cuore. Inoltre, grazie all'analisi dei dati, sapremo sempre come ottimizzare le tue campagne per ottenere il massimo ritorno sull'investimento.
                <br><br>
                Con Jam Web Division, il mondo diventa il tuo mercato. Lascia che ti guidiamo in questa avventura globale: vedrai la tua azienda crescere come mai prima d'ora e raggiungere traguardi che credevi irraggiungibili.
            ",

            "
                Ti sei mai ritrovato a pensare: 'Se solo avessi un sistema che potesse gestire queste attività noiose e ripetitive in modo più efficiente'? Beh, il tuo desiderio può diventare realtà con i Software Gestionali Personalizzati di Jam Web Division.
                <br><br>
                I nostri Software Gestionali Personalizzati non sono semplici strumenti di gestione, ma veri e propri alleati per il tuo business. Sono creati su misura per la tua azienda, rispondendo a tutte le tue specifiche esigenze. Che tu abbia bisogno di un sistema per gestire le vendite, gli acquisti, il magazzino o qualsiasi altra funzione aziendale, noi abbiamo la soluzione per te.
                <br><br>
                Con un software gestionale personalizzato, non solo risparmierai tempo e ridurrai gli errori, ma potrai anche prendere decisioni più informate grazie a report dettagliati e dashboard intuitive. E il bello è che non dovrai preoccuparti della sua gestione: il nostro team di esperti si occuperà di tutto, dalla progettazione alla manutenzione.
                <br><br>
                Il risultato? Un'efficienza operativa senza precedenti, che ti permetterà di concentrarti su ciò che conta davvero: far crescere il tuo business. Lascia che Jam Web Division ti aiuti a semplificare la gestione della tua azienda con un software gestionale personalizzato. La tua azienda te ne sarà grata.
            ",

            "
                In un mondo digitale in continua evoluzione, saper navigare il web è diventato un requisito essenziale per il successo di qualsiasi business. Ecco dove entra in gioco la nostra Consulenza Strategica di Marketing e Web Marketing.
                <br><br>
                La nostra consulenza non è un semplice elenco di consigli generici. È un percorso costruito su misura per la tua azienda, progettato per aiutarti a navigare nel vasto mondo del marketing digitale. Esploreremo insieme il tuo settore, capiremo il tuo target di riferimento e studieremo la tua presenza online attuale. Solo allora, con una chiara visione della tua realtà aziendale, elaboreremo una strategia di marketing e web marketing personalizzata per te.
                <br><br>
                Con la nostra consulenza, potrai fare scelte informate e strategiche. Sarai in grado di identificare le opportunità nascoste nel tuo mercato, capire dove concentrare le tue risorse e come raggiungere efficacemente il tuo pubblico target. E non preoccuparti, non ti lasceremo solo con un piano d'azione: ti affiancheremo in ogni fase del suo sviluppo e implementazione.
                <br><br>
                Non lasciare il tuo successo online al caso. Affidati alla nostra consulenza strategica di marketing e web marketing e trasforma il tuo percorso online in un'avventura di successo. Con Jam Web Division, il web non sarà più un labirinto, ma un mondo di opportunità da esplorare.
            
            ",

            "
                In un mondo digitale dove l'attenzione è una risorsa preziosa, la qualità dei contenuti può fare la differenza. Ecco perché offriamo un servizio di Realizzazione di Contenuti Creativi, che include foto, video, testi e shooting per i social media.
                <br><br>
                Il nostro team di professionisti creativi lavora a stretto contatto con te per capire la tua visione e i tuoi obiettivi. Ci prendiamo il tempo per conoscere a fondo la tua azienda, il tuo brand e il tuo pubblico target, così da creare contenuti che parlino la tua lingua e trasmettano il tuo messaggio nel modo più efficace.
                <br><br>
                Foto nitide e accattivanti, video emozionanti, testi convincenti, shooting social che fanno tendenza: tutto è curato nei minimi dettagli per catturare l'attenzione del tuo pubblico e coinvolgerlo. Ogni pezzo di contenuto che creiamo è un piccolo tassello che contribuisce a costruire la tua immagine di marca e a trasmettere i valori e l'unicità della tua azienda.
                <br><br>
                Con la nostra Realizzazione di Contenuti Creativi, non dovrai più preoccuparti di passare inosservato nel caos del web. I tuoi contenuti non saranno solo piacevoli da vedere o da leggere: saranno un'esperienza indimenticabile per il tuo pubblico, che li porterà a sentire una connessione più profonda con il tuo brand. Affidati a Jam Web Division e lascia che la nostra creatività dia voce al tuo brand.
            ",

            "
                Nell'era digitale, l'aggiornamento costante è fondamentale per restare al passo con i cambiamenti rapidi e per garantire la competitività della tua azienda. Ecco perché Jam Web Division offre Seminari di Formazione mirati a manager, quadri aziendali, reti di vendita e personale dedicato alla gestione dei clienti e alla parte digitale dell'azienda.
                <br><br>
                I nostri seminari sono progettati per fornire competenze pratiche e conoscenze aggiornate sulle ultime tendenze e tecnologie digitali. Attraverso un approccio interattivo e coinvolgente, i partecipanti acquisiranno strumenti e strategie utili da applicare immediatamente nel loro lavoro quotidiano.
                <br><br>
                Ma non ci limitiamo a trasmettere informazioni: il nostro obiettivo è formare veri e propri 'campioni digitali' all'interno della tua azienda. Vogliamo che ogni partecipante si senta coinvolto e motivato a sfruttare le potenzialità del digitale per raggiungere gli obiettivi aziendali.
                <br><br>
                E non preoccuparti se il tuo team ha livelli di competenza diversi: i nostri seminari sono personalizzabili e adattabili alle esigenze specifiche del tuo team. Possiamo creare percorsi formativi su misura, che rispondano alle necessità di formazione di ogni singolo membro del tuo team.
                <br><br>
                Con i Seminari di Formazione di Jam Web Division, la trasformazione digitale della tua azienda sarà un viaggio appassionante, che coinvolgerà e stimolerà tutto il tuo team. Fai un investimento sul tuo capitale umano: mettici alla prova e vedrai che i risultati non tarderanno ad arrivare.

            "
        ];
    */

    $array_txt2_serv = [
        "
            Il tuo sito web, non un mero strumento, ma l'eco della tua visione, il tuo brand trasformato in una sinfonia digitale.
            <br><br>
            Ogni sito che realizziamo è come una partitura scritta su misura per il tuo brand, combinando design affascinante, funzionalità intuitive e contenuti che risuonano con il tuo pubblico. Progettiamo esperienze web che attirano, coinvolgono e convertono.
            <br><br>
            Come il maestro d'orchestra che accorda e guida gli strumenti musicali, noi sintonizziamo il tuo sito web alle ultime tendenze, tecnologie e aspettative del tuo settore. Creiamo siti pronti a evolvere con il tuo business, capaci di adattarsi e crescere con l'evoluzione del web.
            <br><br>
            Il tuo sito web non è solo una presenza online, è il tuo biglietto da visita digitale, l'espressione del tuo brand, il tuo ambasciatore online. Affidati a noi per trasformarlo in un vero protagonista della tua avventura digitale.
            <br><br>
        ",

        "
            Immagina il tuo negozio online come una grande sala concerti, vibrante e accogliente, dove ogni prodotto canta la sua unica melodia, conquistando il pubblico con la sua storia.
            <br><br>
            Nel tuo e-commerce, ogni dettaglio conta. Dalla vetrina dei prodotti all'esperienza di acquisto, tutto deve essere accordato alla perfezione per convertire i visitatori in clienti fedeli. Noi costruiamo e-commerce sicuri, intuitivi e performanti, che risuonano con il tuo brand e le aspettative del tuo pubblico.
            <br><br>
            Come il direttore d'orchestra che guida e coordina i musicisti, noi ottimizziamo la tua piattaforma e-commerce per garantire prestazioni superiori, scalabilità e un'esperienza utente senza intoppi. E, proprio come un concerto, il tuo e-commerce deve saper evolvere, offrendo sempre nuovi spunti e stimoli al tuo pubblico.
            <br><br>
            Il tuo e-commerce non è solo un negozio online, è un'esperienza che riflette il tuo brand e le tue promesse. Con Jam Web Division, il tuo e-commerce diventa un vero e proprio spettacolo, che incanta, coinvolge e fidelizza i tuoi clienti. Affidati a noi per trasformare il tuo e-commerce in un punto di riferimento nel tuo settore.
            <br><br>
        ",

        "
            Come le note di una melodia che si diffondono nell'aria, così i tuoi messaggi si propagano sui social media, raggiungendo e coinvolgendo il tuo pubblico.
            <br><br>
            Pensa ai tuoi canali social come a musicisti talentuosi che, con il loro canto, portano la tua marca vicino alle persone, creando emozioni, suscitando interessi e costruendo relazioni durature. La nostra missione è far suonare ogni canale social al ritmo giusto, orchestrando una sinfonia di contenuti che rifletta la tua identità di marca e parli direttamente al cuore del tuo pubblico.
            <br><br>
            Il Social Media Marketing non è solo una questione di postare contenuti, è una danza strategica, che richiede tempismo, precisione e sensibilità per le dinamiche social. Come direttori d'orchestra, noi armonizziamo la tua presenza sui social, studiando le tendenze, capendo il comportamento del tuo pubblico e creando strategie che catturano l'attenzione e coinvolgono attivamente i tuoi follower.
            <br><br>
            I social media sono il tuo palcoscenico. Lascia che Jam Web Division diriga il concerto, creando melodie virali che risuonino con il tuo brand e coinvolgano il tuo pubblico in un dialogo costante. Non è solo marketing, è l'arte di creare relazioni autentiche attraverso la condivisione di storie che toccano le corde giuste. Affidati a noi per trasformare i tuoi social media in potenti strumenti di business.
            <br><br>
        ",

        "
            Come un violino solista che fa risuonare le note più emozionanti, così le tue campagne pubblicitarie riecheggiano attraverso i confini, raggiungendo e persuadendo clienti in tutto il mondo.
            <br><br>
            Immagina la tua campagna come una partitura ben scritta, capace di trasmettere un messaggio universale che parla a diverse culture, generazioni e stili di vita. Noi siamo i compositori di questa sinfonia globale. Creiamo strategie pubblicitarie personalizzate che interpretino l'unicità del tuo brand e parlino la lingua del tuo pubblico target, ovunque si trovi.
            <br><br>
            Ma il nostro ruolo non finisce con la creazione della campagna. Come direttori d'orchestra, monitoriamo costantemente l'esecuzione, affinando e ottimizzando le performance in tempo reale per assicurare che ogni nota suonata, ogni messaggio trasmesso, risuoni con forza e precisione.
            <br><br>
            Viviamo in un mondo connesso, dove la distanza non è più un ostacolo ma un'opportunità. Lascia che Jam Web Division ti guidi in questa avventura globale, componendo la melodia della tua campagna pubblicitaria internazionale, che riecheggerà nelle menti e nei cuori del tuo pubblico, ovunque esso sia. Con noi, il tuo brand non conoscerà più confini.
            <br><br>
        ",

        "
            Così come ogni componente dell'orchestra ha un ruolo vitale nell'armonia complessiva, anche ogni dettaglio del tuo business contribuisce a formare l'immagine generale della tua azienda.
            <br><br>
            Considera il software gestionale come il tuo strumento di precisione, progettato per suonare le note perfette del tuo specifico business. Ogni azienda è unica, e crediamo che lo strumento utilizzato per gestirla dovrebbe riflettere tale unicità. Da questo principio, nasce la nostra dedizione a creare software gestionali su misura, che rispecchino e migliorino i tuoi processi aziendali.
            <br><br>
            Ci piace pensare ai software gestionali come ai violoncelli dell'orchestra digitale: robusti, versatili e indispensabili, capaci di sostenere l'armonia complessiva, mantenendo il ritmo e garantendo che ogni nota risuoni chiara e forte.
            <br><br>
            Con i nostri Software Gestionali Personalizzati, il tuo business suonerà una melodia di efficienza e precisione, ottimizzando i processi aziendali e rendendo la gestione quotidiana un'esperienza fluida e intuitiva. Lascia che Jam Web Division trasformi la tua attività in una sinfonia di successo.
            <br><br>
        ",

        "
            Considera questo servizio come il tuo personale maestro d'orchestra, capace di guidare con maestria ogni sezione del tuo ensemble digitale.
            <br><br>
            Proprio come un direttore d'orchestra studia attentamente ogni spartito, valuta le dinamiche dell'ensemble e decide il modo migliore per presentare una melodia, così i nostri specialisti di marketing strategico analizzano il tuo mercato, comprendono i tuoi obiettivi e creano piani d'azione personalizzati per raggiungerli.
            <br><br>
            Crediamo fermamente che la strategia sia l'essenza di ogni sinfonia di successo nel mondo digitale. Una strategia ben congegnata e ben eseguita può fare la differenza tra un concerto ordinario e uno che incanta il pubblico e risuona nelle loro menti molto tempo dopo la sua esecuzione.
            <br><br>
            Jam Web Division con il Marketing Strategico ti garantisce la creazione di un piano d'azione armonioso, su misura per il tuo brand, che catturerà l'attenzione del tuo pubblico e lo guiderà delicatamente lungo il percorso che hai scelto. Lascia che ti aiutiamo a dirigere la tua melodia verso il successo.
            <br><br>
        ",

        "
            L'equivalente di un assolo incantevole. È quel momento magico in cui un singolo strumento o una voce cattura l'attenzione, risuona chiaramente sopra l'orchestra e trasmette un messaggio potente che tocca il cuore dell'ascoltatore.
            <br><br>
            Le parole, le immagini, i video hanno il potere di narrare storie, suscitare emozioni, comunicare idee e costruire relazioni. Nella comunicazione digitale, la qualità del tuo contenuto può fare la differenza tra passare inosservati o essere ascoltati, apprezzati e condivisi.
            <br><br>
            Sappiamo quanto sia importante per il tuo brand avere contenuti unici e di alta qualità, che rispecchino la tua identità, i tuoi valori, i tuoi obiettivi. Ecco perché il nostro team di professionisti si impegna per creare contenuti su misura, che siano capaci di catturare l'attenzione del tuo pubblico e di lasciare un'impronta duratura.
            <br><br>
            Lasciati sorprendere dal potere espressivo delle nostre creazioni. Con Jam Web Division, la tua storia sarà la melodia che tutti vorranno ascoltare.
            <br><br>
        ",

        "
            Nella grande sinfonia digitale, il nostro servizio è come l'affinare l'abilità di un musicista. La formazione non è un'ardua salita, ma un potente alleato, un viaggio di scoperta e crescita.
            <br><br>
            Così come un musicista conosce alla perfezione il suo strumento, così un team aziendale formato da Jam Web Division saprà navigare con destrezza nel mondo del web, cogliendo le opportunità e affrontando le sfide che si presentano.
            <br><br>
            Il nostro obiettivo è dotare il tuo team delle competenze necessarie per comprendere, utilizzare e sfruttare al meglio le potenzialità del web. Trasferiamo non solo le nozioni tecniche, ma anche la strategia, la visione, l'approccio giusto per far sì che il digitale diventi un alleato fedele nel tuo percorso di crescita.
            <br><br>
            Con Jam Web Division, il tuo team sarà in grado di suonare la melodia del successo digitale, in armonia con il ritmo di continua evoluzione del web. La formazione non sarà più un ostacolo, ma l'archetto che fa vibrare le corde del tuo violino, dando vita a una melodia unica e affascinante.
            <br><br>
        "
    ];

    $array_data_section_modal = [
        "34", // "Siti Web Rivoluzionari",
        "35", // "Piattaforme E-Commerce Performanti",
        "36", // "Social Media Marketing per il Business",
        "37", // "Campagne Pubblicitarie Internazionali",
        "38", // "Software Gestionali Personalizzati",
        "39", // "Consulenze di Marketing Strategico",
        "40", // "Foto, Video, Testi e Shooting Social",
        "41", // "Formazione Quadri Aziendali per il Digitale"
    ];

    for($i = 0; $i < count($array_title_serv); $i++)
    {

        $lista_servizi .= "
            <div class='c-col-4 pl-0'>
                <div class='box-grid'>
                    <div class='a-button style_1 light'>
                        <span class='button-overlay'></span> 
                        <a class='grid-title' id=\"oModal_serv_$i\" onclick=\"openModal('myModal_serv_$i')\"> 
                            $array_title_serv[$i] 
                            <i class='icofont-arrow-right icon-btn c-white arrow-grid'></i> 
                        </a>
                    </div>
                </div>
            </div>
        ";



        $lista_modal_servizi .= "
            <div id='myModal_serv_$i' class='modal modal_move track-section' data-section='$array_data_section_modal[$i]'>
                <div class='modal-content'>

                    <div class='wrapper'>
                        <div class='c-col-4 hide_mobile'>
                            <div class='text-wrapper'>
                                <h3>
                                    $array_txt1_serv[$i]
                                </h3>
                            </div>
                        </div>
                        <div class='c-col-8'>
                            <div class='text-wrapper'>

                                <h2 class='h2-tradizione'>
                                    $array_title_serv[$i] 
                                </h2>

                                <p class='p-tradizione'>
                                    $array_txt2_serv[$i]
                                </p>

                                <div class='a-button style_1 bg-white-btn mr-10'>
                                    <span class='button-overlay'></span> 
                                    <a id='cModal_serv_$i' onclick=\"closeModal('myModal_serv_$i')\" 
                                        class='close c-black btn-inverse-padding fs-18 fs-16-m mr-10-m'> 
                                        Indietro <i class='c-black fix-serv-2 icofont-rounded-left mr-5-m'></i>
                                    </a>
                                </div>

                                <div class='a-button style_1'> 
                                    <a href='#form-landing-jwd' class='text-btn c-white popup-form fs-16-m'>Contattaci</a> 
                                    <i class='icofont-arrow-right icon-btn c-white icon-contact'></i> 
                                </div>

                                <span class='a-empty-space' style='height: 200px'></span> 


                            </div>

                        </div>
                        
                    </div>

                </div>
            </div>
        ";
    }

    $array_title_serv_ai = [
        "AI Etica nel Marketing e nelle Vendite",
        "Sviluppo di Algoritmi Sartoriali di AI"
    ];

    $array_txt1_serv_ai = [
        "Analisi dati e tendenze di mercato con AI <br>
        Segmentazione del pubblico e profilazione avanzata <br>
        Creazione di campagne pubblicitarie personalizzate con AI <br>
        Analisi risultati delle campagne e ottimizzazione in tempo reale <br>
        Indicazioni sul comportamento del consumatore e anticipazione delle tendenze
        ",

        "Analisi processi aziendali interni ed identificazione aree di miglioramento <br>
        Progettazione e sviluppo di algoritmi AI su misura <br>
        Integrazione degli algoritmi AI nei sistemi aziendali esistenti <br>
        Monitoraggio delle performance e aggiornamenti periodici degli algoritmi
        "
    ];

    /*
        $array_txt2_serv_ai = [
            "Nel mondo del business digitale, l'Intelligenza Artificiale è diventata un alleato prezioso per massimizzare l'efficacia della comunicazione, del marketing e delle vendite. Ma come garantire che il suo utilizzo rispetti principi etici e sia orientato al vero beneficio del cliente? Ecco dove entra in gioco Jam Web Division.
            <br><br>
            La nostra proposta è un servizio che utilizza l'Intelligenza Artificiale in modo etico, al fine di migliorare le tue strategie di comunicazione e marketing e potenziare le tue vendite. Attraverso algoritmi sofisticati, possiamo analizzare dati e tendenze, prevedere comportamenti dei clienti e personalizzare messaggi e offerte, garantendo sempre il rispetto della privacy e dei diritti dei consumatori.
            <br><br>
            Con l'Intelligenza Artificiale Etica, la tua azienda potrà raggiungere un livello di precisione e personalizzazione mai visto prima. Sarai in grado di comprendere meglio i tuoi clienti, anticipare i loro bisogni e desideri, e interagire con loro in modo più efficace e coinvolgente. Inoltre, potrai ottimizzare le tue risorse, riducendo sprechi e aumentando l'efficienza delle tue campagne di marketing e vendita.
            <br><br>
            Ma non preoccuparti: non è necessario essere un esperto di tecnologia per sfruttare i benefici dell'Intelligenza Artificiale. Noi di Jam Web Division ci occupiamo di tutto, fornendoti soluzioni chiavi in mano e assistenza continua. E lo facciamo sempre nel rispetto dei valori etici che ci guidano: trasparenza, rispetto per l'individuo e responsabilità sociale.
            <br><br>
            Con Jam Web Division, l'Intelligenza Artificiale non sarà più un concetto astratto o una minaccia, ma un vero e proprio partner di business, che ti aiuterà a raggiungere i tuoi obiettivi in modo più rapido e sostenibile. Fidati della nostra esperienza e scopri come l'Intelligenza Artificiale Etica può rivoluzionare il tuo business.
            ",

            "Nel mondo digitale, l'Intelligenza Artificiale (AI) è un potente strumento che può trasformare radicalmente il modo in cui fai business. Ma come fare a sfruttare al meglio questa tecnologia e renderla davvero utile per la tua azienda? La risposta è semplice: con lo sviluppo di algoritmi sartoriali di AI per il business, offerto da Jam Web Division.
            <br><br>
            Questo servizio unico nel suo genere ti permette di avere a disposizione algoritmi di Intelligenza Artificiale progettati su misura per la tua azienda. Questi algoritmi possono essere utilizzati per ottimizzare una vasta gamma di processi aziendali, dalla gestione delle risorse al monitoraggio delle performance, dall'analisi dei dati clienti alla previsione delle tendenze di mercato.
            <br><br>
            Con gli algoritmi sartoriali di AI, la tua azienda sarà in grado di prendere decisioni più informate e accurate, migliorare l'efficienza operativa e guadagnare un vantaggio competitivo. Sarai in grado di anticipare le esigenze dei tuoi clienti, individuare nuove opportunità di business e adattarti rapidamente ai cambiamenti del mercato.
            <br><br>
            Ma non preoccuparti se l'Intelligenza Artificiale sembra un concetto complesso o intimidatorio. Noi di Jam Web Division siamo qui per guidarti in ogni fase del processo, dallo sviluppo alla implementazione degli algoritmi. Ti forniremo supporto e consulenza continua, assicurandoci che tu possa sfruttare al meglio i benefici dell'AI senza dover affrontare la sua complessità tecnica.
            <br><br>
            Inoltre, ci impegniamo a rispettare principi etici nell'uso dell'Intelligenza Artificiale, garantendo la privacy e la sicurezza dei tuoi dati e mettendo sempre al centro le esigenze del tuo business.
            <br><br>
            Scegliere lo sviluppo di algoritmi sartoriali di AI per il business significa scegliere un futuro più intelligente e sostenibile per la tua azienda. Lascia che Jam Web Division ti guidi in questa avventura digitale e scopri come l'Intelligenza Artificiale può dare nuova vita al tuo business.
            "
        ];
    */

    $array_txt2_serv_ai = [
        "
            Nella sinfonia del web, il nostro servizio agisce come un virtuoso pianista, in grado di sfruttare la potenza della tecnologia per creare una melodia che risuoni con precisione e sensibilità.
            <br><br>
            Così come il pianista conosce a fondo il suo strumento, comprendendone le potenzialità, così noi conosciamo e rispettiamo l'importanza dell'etica nell'utilizzo dell'Intelligenza Artificiale.
            <br><br>
            Il nostro obiettivo è impiegare l'IA per potenziare le tue strategie di marketing e vendita, ma senza perdere mai di vista l'importanza ed il rispetto per l'individuo e per le responsabilità sociali. Usiamo l'IA non come un freddo calcolatore, ma come uno strumento in grado di creare un'armonia tra il tuo brand e il tuo pubblico, rispettando le individualità e le esigenze di ognuno.
            <br><br>
            Con Jam Web Division, l'IA diventa un elemento centrale della tua orchestra digitale, una presenza che non sovrasta, ma che arricchisce la melodia, creando un suono ricco, variegato e armonioso, che segue il ritmo del tuo business ed i valori del tuo pubblico.
            <br><br>
        ",

        "
            Gli algoritmi di Intelligenza Artificiale sono lo strumento più innovativo e prezioso per la tua sinfonia digitale. 
            Sviluppiamo algoritmi di Intelligenza Artificiale personalizzati, 
            che rifiniscono le performance del tuo business come un maestro accorda il suo prezioso strumento. 
            <br><br>
            L'AI può valorizzare ogni aspetto della tua attività e diventare un amico fidato.
            <br><br>
            Curioso di sapere come l'Intelligenza Artificiale può fare la differenza per il tuo business? <br>
            Parliamone davanti ad una tazza di caffè.
            <br><br>
        "
    ];

    $array_data_section_modal_ai = [
        "42", // "AI Etica nel Marketing e nelle Vendite",
        "43"  // "Sviluppo di Algoritmi Sartoriali di AI"
    ];

    for($i = 0; $i < count($array_title_serv_ai); $i++)
    {

        $lista_servizi_ai .= "
            <div class='c-col-4 pl-0'>
                <div class='box-grid'>
                    <div class='a-button style_1 dark'>
                        <span class='button-overlay'></span> 
                        <a class='grid-title' id=\"oModal_ai_$i\" onclick=\"openModal('myModal_ai_$i')\"> 
                            $array_title_serv_ai[$i] 
                            <i class='icofont-arrow-right icon-btn c-white arrow-grid'></i> 
                        </a>
                    </div>
                </div>
            </div>
        ";

        $lista_modal_servizi_ai .= "
            <div id='myModal_ai_$i' class='modal modal_move track-section' data-section='$array_data_section_modal_ai[$i]'>
                <div class='modal-content'>

                    <div class='wrapper'>
                        <div class='c-col-4 hide_mobile'>
                            <div class='text-wrapper'>
                                <h3>
                                    $array_txt1_serv_ai[$i]
                                </h3>
                            </div>
                        </div>
                        <div class='c-col-8'>
                            <div class='text-wrapper'>

                                <h2 class='h2-tradizione'>
                                    $array_title_serv_ai[$i] 
                                </h2>

                                <p class='p-tradizione'>
                                    $array_txt2_serv_ai[$i]
                                </p>

                                <div class='a-button style_1 bg-white-btn mr-10'>
                                    <span class='button-overlay'></span> 
                                    <a id='cModal_ai_$i' onclick=\"closeModal('myModal_ai_$i')\" 
                                        class='close c-black btn-inverse-padding fs-18 fs-16-m mr-10-m'> 
                                        Indietro <i class='c-black fix-serv-2 icofont-rounded-left mr-5-m'></i>
                                    </a>
                                </div>

                                <div class='a-button style_1'> 
                                    <a href='#form-landing-jwd' class='text-btn c-white popup-form fs-16-m'>Contattaci</a> 
                                    <i class='icofont-arrow-right icon-btn c-white icon-contact'></i> 
                                </div>

                                <span class='a-empty-space' style='height: 200px'></span> 


                            </div>

                        </div>
                        
                    </div>

                </div>
            </div>
        ";
    }

    $array_title_faq = [
        "Perché scegliere Jam Web Division per il mio marketing digitale?",
        "Come personalizza Jam Web Division le strategie di marketing per il mio business?",
        "Qual è l'approccio di Jam Web Division nei confronti dei clienti?",
        "In che modo Jam Web Division si impegna nell'innovazione e nella tecnologia?",
        "Fate siti web?",
        "Quanto costa un sito web?",
        "Quanto tempo impiegate per realizzare un sito web?",
        "Offrite servizi di manutenzione e aggiornamento del sito web?",
        "Gestite campagne pubblicitarie internazionali sui social media?",
        "Realizzate anche soluzioni gestionali personalizzate per le aziende?",
        "Realizzate progetti standard?"
    ];

    $array_txt1_faq = [
        "Jam Web Division è la scelta ideale per un'esperienza di marketing digitale unica e su misura. Uniamo valori tradizionali e innovazione, trasformando la complessità del web in un'avventura affascinante. Il nostro approccio etico, personalizzato e orientato al cliente ti aiuterà a raggiungere il successo online che desideri.",
        "La nostra Sartoria Digitale prende a cuore le tue esigenze, studiando la tua azienda, il tuo settore e il tuo target di riferimento. In base a queste analisi, creiamo una strategia su misura, combinando campagne social personalizzate, siti web, piattaforme e-commerce e soluzioni tecnologiche all'avanguardia.",
        "Per noi, l'imprenditore è la vera anima del business, e vogliamo scoprire la persona che si cela dietro l'azienda. La nostra priorità è tessere un'autentica relazione umana, convinti che sia il segreto per un'esperienza online di successo.",
        "Jam Web Division è sempre alla ricerca di nuove tecnologie e soluzioni digitali per assicurare un vantaggio competitivo ai nostri clienti. Innovazione, AI solo etica e competenza tecnologica sono il cuore del nostro lavoro, permettendoci di offrire soluzioni di marketing efficaci e all'avanguardia.",
        "Sì, Jam Web Division realizza siti web personalizzati e di alta qualità. Creiamo siti web che rispecchino la tua identità aziendale e le tue esigenze, utilizzando le ultime tecnologie e tendenze del design per offrire un'esperienza utente ottimale. Performance e velocità del sito sono assicurate dai nostri server Business dedicati. ",
        "Il costo di un sito web può cambiare in base a diverse variabili, come la complessità del progetto, le funzionalità richieste e il tempo necessario per completarlo. Per fornirti un preventivo dettagliato e su misura, ti invitiamo a contattarci e discutere insieme le tue esigenze specifiche.",
        "Il tempo necessario per completare un sito web dipende dall'ampiezza e dalla complessità del progetto, oltre che dalle richieste specifiche del cliente. Di solito, un sito web di base può essere completato entro 4-6 settimane, mentre progetti più complessi potrebbero richiedere un tempo maggiore. In ogni caso, ci impegniamo a rispettare le tempistiche concordate e a tenerti costantemente aggiornato sullo stato di avanzamento del progetto.",
        "Sì, Jam Web Division offre servizi di manutenzione e aggiornamento del sito web per assicurare che il tuo sito sia sempre all'avanguardia e che funzioni correttamente. Ci prendiamo cura di tutti gli aspetti tecnici e delle eventuali modifiche richieste, permettendoti di concentrarti sul tuo business.",
        "Certo! La nostra squadra di esperti è in grado di creare e gestire campagne pubblicitarie sui social media a livello internazionale. Teniamo conto delle specificità culturali e linguistiche di ciascun mercato, per garantire che i messaggi e le strategie di marketing siano efficaci e coinvolgenti per il pubblico target in tutto il mondo.",
        "Sì, realizziamo soluzioni gestionali personalizzate per le aziende, grazie ai nostri algoritmi di intelligenza artificiale, ottimizziamo i processi interni e miglioriamo l'efficienza operativa (magazzino, vendite, approvvigionamenti). Il nostro team di sviluppatori e consulenti analizza le esigenze specifiche del tuo business per progettare e implementare strumenti gestionali su misura, che ti permettano di raggiungere gli obiettivi aziendali in modo più rapido ed efficiente.",
        "No, non realizziamo progetti standard. La nostra filosofia è quella di offrire soluzioni su misura, progettate specificamente per rispondere alle esigenze e agli obiettivi di ogni singolo cliente. Crediamo fermamente che ogni azienda sia unica e che meriti un'attenzione personalizzata e dedicata. In questo modo, possiamo assicurare risultati ottimali e strategie di marketing e comunicazione che si adattino perfettamente al tuo business, contribuendo al tuo successo nel mondo digitale."
    ];


    $array_data_section_faq = [
        "21", // "Perché scegliere Jam Web Division per il mio marketing digitale?",
        "22", // "Come personalizza Jam Web Division le strategie di marketing per il mio business?",
        "23", // "Qual è l'approccio di Jam Web Division nei confronti dei clienti?",
        "24", // "In che modo Jam Web Division si impegna nell'innovazione e nella tecnologia?",
        "25", // "Fate siti web?",
        "26", // "Quanto costa un sito web?",
        "27", // "Quanto tempo impiegate per realizzare un sito web?",
        "28", // "Offrite servizi di manutenzione e aggiornamento del sito web?",
        "29", // "Gestite campagne pubblicitarie internazionali sui social media?",
        "30", // "Realizzate anche soluzioni gestionali personalizzate per le aziende?",
        "31", // "Realizzate progetti standard?"
    ];

    for($i = 0; $i < count($array_title_faq); $i++)
    {
        $lista_faq .= "
            <div class='service service-faq track-section' data-section='$array_data_section_faq[$i]'>
                <div class='service-title tit-faq'>
                    $array_title_faq[$i]
                </div>

                <div class='service-toggle'>
                    <i class='icofont-thin-down'></i>
                </div>

                <div class='service-wrap'>
                    <div class='service-cont'>
                        <p class='p-tradizione'>$array_txt1_faq[$i]</p>
                    </div> 
                </div> 

            </div>
            ";
    }


    $size_scritta = getimagesize("img/webp/scritta_logo_jwd.webp");

    $img_scritta_logo = "<img class='scritta-logo' src='$url_default/img/webp/scritta_logo_jwd.webp' $size_scritta[3] loading='eager' title='Logo Jam Web Division | Jam Communication' alt='Logo' />";


    $body_settings = "
        data-cursor='true' 
        data-header-sticky='true' 
        data-menu-style='classic' 
        data-page-layout='light' 
        data-header-layout='dark' 
        data-menu-layout='light' 
        data-footer-layout='light' 
        data-page-loader='false'
    ";

    $title_seo = "Sartoria Digitale | Jam Web Division";
    $description_seo = "Scopri i servizi di marketing digitale di Jam Web Division: siti web, e-commerce, social media, contenuti creativi, intelligenza artificiale e soluzioni su misura per il tuo business.";

    $web_active = "active-menu";

    $mx_pers_1 = "";
    $mx_pers_2 = "";
    $mx_pers_3 = "";


    //PERSONALIZZAZIONE
    $emailTo = "test@jamwebdivision.it"; 
    $clientEmail = "test@jamwebdivision.it";
    $emailIdentifier =  "[JWD] Nuova visita Personalizzata";
    $oggi_ora  = date("Y-m-d H:i:s");
    $message_body = "";

    if(array_key_exists('nome', $_POST))
    {   
        $sql_post = escape($_POST);

        $post_source = addslashes(trim($sql_post['source']));
        $post_nome = addslashes(trim($sql_post['nome']));
        // $post_cognome = addslashes(trim($sql_post['cognome']));


        $cookie_nome = array_key_exists('pers_nome_JWD', $_COOKIE) ? $_COOKIE['pers_nome_JWD'] : null;
        // $cookie_cognome = array_key_exists('pers_cognome_JWD', $_COOKIE) ? $_COOKIE['pers_cognome_JWD'] : null;
    }

    if( ($post_source != "" && $post_nome != "") || ($cookie_nome != NULL) )
    {
        
        if($cookie_nome != NULL)
        {
            //cookie già settato
            $sel_nome = "$cookie_nome";
            // $sel_cognome = "$cookie_cognome";

            $expire = time()+60*60*24*30;
            setcookie("pers_nome_JWD", "$cookie_nome", $expire);
            // setcookie("pers_cognome_JWD", "$cookie_cognome", $expire);

            $emailIdentifier .= " - RITORNATO";
            $flag_text = "tornato";

            if($post_source == "")
            {
                $post_source = "direct";
            }
                
        }
        else
        {
            $sel_nome = "$post_nome";
            // $sel_cognome = "$post_cognome";

            $expire = time()+60*60*24*30;
            setcookie("pers_nome_JWD", "$post_nome", $expire);
            // setcookie("pers_cognome_JWD", "$post_cognome", $expire);

            $emailIdentifier .= " - PRIMA VOLTA";
            $flag_text = "prima visita";
        }

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $sel_nome . " <" . $clientEmail .">\r\n";
        $headers .= "Reply-To: " . $clientEmail;
        $message_body .= "Nome: " . $sel_nome . "\r\n <br>";
        // $message_body .= "Cognome: " . $sel_cognome . "\r\n <br>";
        $message_body .= "Visita effettuate in data: $oggi_ora \r\n <br>";
        $message_body .= "Provenienza Lead: " . $post_source . "\r\n <br>";

        
        //mail($emailTo, $emailIdentifier, $message_body, $headers);

        do_query("INSERT INTO  lead_campagna_jwd    (nome, data_visita, source, flag, stato) 
                    VALUES                          ('$sel_nome','$oggi_ora', '$post_source', '$flag_text', 1) ");


        $mx_pers_1 = "
            <h2 class='has-anim big-title thin-txt mt-40' data-stagger='0.01' data-duration='1.2' data-delay='0' data-animation='charsUp'>
                Gentile $sel_nome, ti diamo il benvenuto nella nostra SARTORIA DIGITALE.
            </h2>
        ";

        $mx_pers_2 = "
            <h3 class='has-anim fs-175r p-tradizione' data-stagger='0.05' data-duration='1.25' data-delay='.5' data-animation='linesUp'>            
                Condividiamo con te $sel_nome una frase di Seneca a cui ci siamo ispirati nell'arte di fare business: <br>
                <span class='italic'>\"L'arciere non deve colpire nel segno solo qualche volta, solo qualche volta egli può sbagliare il colpo\".</span> 
            </h3>
        ";

        $mx_pers_3 = "
            <h3 class='has-anim fs-175r p-tradizione maxw-950 mb-20' data-stagger='0.05' data-duration='1.25' data-delay='.5' data-animation='linesUp'>
                $sel_nome, se ti stai chiedendo come ottenere i migliori risultati e le migliori performance sul web, dobbiamo comprendere insieme i meccanismi che lo regolano.
                Siamo convinti che dopo aver fatto una chiaccherata con noi, ti si aprirà uno scenario chiaro e comprensibile, 
                che ti permetterà di individuare il miglior percorso da seguire per il tuo business.
            </h3>
        ";

        $mx_pers_4 = "
            <br><br>
            Ricorda $sel_nome, il pulsante Whatsapp è sempre a tua disposizione. <br>
            La tua voce o un semplice messaggio sono importanti per noi.
        ";

        $mx_pers_5 = "
            $sel_nome abbiamo pensato di proporti le risposte alle domande più frequenti, convinti che possano esserti utili.
        ";

    }
    else
    {
        $mx_pers_3 = "
            <h3 class='has-anim fs-175r p-tradizione maxw-950 mb-20' data-stagger='0.05' data-duration='1.25' data-delay='.5' data-animation='linesUp'>
                Se ti stai chiedendo come ottenere i migliori risultati e le migliori performance sul web, dobbiamo comprendere insieme i meccanismi che lo regolano.
                Siamo convinti che dopo aver fatto una chiaccherata con noi, ti si aprirà uno scenario chiaro e comprensibile, 
                che ti permetterà di individuare il miglior percorso da seguire per il tuo business.
            </h3>
        ";

        $mx_pers_4 = "

        ";

        $mx_pers_5 = "
            Abbiamo pensato di proporti le risposte alle domande più frequenti.
        ";
    }

    if ($detect->isMobile() or $detect->isTablet()) {
        // MOBILE & TABLET CODE
        $array_img_shooting_jwd = [
            "sviluppo-siti-web-2-jam-web-division-m.webp",
            "piattaforme-ecommerce-jam-web-division-m.webp",
            "social-media-marketing-jam-web-division-m.webp",
            "campagne-pubblicitarie-internazionali-jam-web-division-m.webp",
            "software-gestionali-jam-web-division-m.webp",
            "consulenza-strategica-2-jam-web-division-m.webp",
            "foto-video-testi-jam-web-division-m.webp",
            "seminari-formazione-jam-web-division-m.webp"
        ];
        
    }
    else {
        // DESKTOP CODE
            
        $array_img_shooting_jwd = [
            "sviluppo-siti-web-2-jam-web-division.webp",
            "piattaforme-ecommerce-jam-web-division.webp",
            "social-media-marketing-jam-web-division.webp",
            "campagne-pubblicitarie-internazionali-jam-web-division.webp",
            "software-gestionali-jam-web-division.webp",
            "consulenza-strategica-2-jam-web-division.webp",
            "foto-video-testi-jam-web-division.webp",
            "seminari-formazione-jam-web-division.webp"
        ];
    
    }


    $array_title_shooting_jwd = [
        "Siti Web Rivoluzionari",
        "E-Commerce Performanti",
        "Social Media Marketing per il Business",
        "Campagne Pubblicitarie Internazionali",
        "Software Gestionali Personalizzati",
        "Consulenze di Marketing Strategico",
        "Foto, Video, Testi e Shooting Social",
        "Formazione Quadri Aziendali per il Digitale"
    ];

    $array_data_section = [
        "7",    //"Siti Web Rivoluzionari"
        "8",    // "E-Commerce Performanti",
        "9",    // "Social Media Marketing per il Business",
        "10",    // "Campagne Pubblicitarie Internazionali",
        "11",    // "Software Gestionali Personalizzati",
        "12",    // "Consulenze di Marketing Strategico",
        "13",    // "Foto, Video, Testi e Shooting Social",
        "14",    // "Formazione Quadri Aziendali per il Digitale"
    ];

    for($j = 0; $j < count($array_img_shooting_jwd); $j++)
    {
        $lista_servizi_img .= "
            <div class='ar-work track-section' data-section='$array_data_section[$j]'>
                <a class='cursor-on' id=\"oModal_serv_$j\" onclick=\"openModal('myModal_serv_$j')\" >
                    <div class='ar-work-image'>
                        <img src='img/shooting-jwd-web/$array_img_shooting_jwd[$j]' loading='lazy' alt='$array_title_shooting_jwd[$j] | Jam Web Division' title='$array_title_shooting_jwd[$j] | Jam Web Division' >
                    </div>
                    <div class='ar-work-title link-servizio-tit'>$array_title_shooting_jwd[$j]</div>  
                </a>
            </div>
        ";

        $lista_servizi_col_mobile .= "
            <div class='c-col-12 track-section' data-section='$array_data_section[$j]'>
                <a class='cursor-on' id=\"oModal_serv_$j\" onclick=\"openModal('myModal_serv_$j')\" >
                    <div class='ar-work-image'>
                        <img src='img/shooting-jwd-web/$array_img_shooting_jwd[$j]' loading='lazy' alt='>$array_title_shooting_jwd[$j] | Jam Web Division' title='>$array_title_shooting_jwd[$j] | Jam Web Division' >
                    </div>
                    <div class='ar-work-title link-servizio-tit'>$array_title_shooting_jwd[$j]</div>  
                </a>
            </div>
        ";
    }

    if ($detect->isMobile() or $detect->isTablet()) {
        // MOBILE & TABLET CODE
        $array_img_shooting_jwd_ai = [
            "ai-etica-marketing-jam-web-division-m.webp",
            "sviluppo-algoritmi-ai-jam-web-division-m.webp"
        ];
    }
    else {
        // DESKTOP CODE
        $array_img_shooting_jwd_ai = [
            "ai-etica-marketing-jam-web-division.webp",
            "sviluppo-algoritmi-ai-jam-web-division.webp"
        ];
    }

    $array_title_shooting_jwd_ai = [
        "AI applicata al Marketing e Vendite",
        "Algoritmi di AI per E-Commerce e Siti Web"
    ];

    $array_data_section_ai = [
        "16", // "AI applicata al Marketing e Vendite",
        "17"  // "Algoritmi di AI per E-Commerce e Siti Web"
    ];

    for($j = 0; $j < count($array_img_shooting_jwd_ai); $j++)
    {
        $lista_servizi_img_ai .= "
            <div class='ar-work track-section' data-section='$array_data_section_ai[$j]'>
                <a class='cursor-on' id=\"oModal_ai_$j\" onclick=\"openModal('myModal_ai_$j')\">
                    <div class='ar-work-image'>
                        <img src='img/shooting-jwd-web/$array_img_shooting_jwd_ai[$j]' loading='lazy' alt='$array_title_shooting_jwd_ai[$j] | Jam Web Division' title='$array_title_shooting_jwd_ai[$j] | Jam Web Division' >
                    </div>
                    <div class='ar-work-title c-white link-servizio-tit'>$array_title_shooting_jwd_ai[$j]</div>  
                </a>
            </div>
        ";

        $lista_servizi_col_mobile_ai .= "
            <div class='c-col-12 track-section' data-section='$array_data_section_ai[$j]'>
                <a class='cursor-on' id=\"oModal_ai_$j\" onclick=\"openModal('myModal_ai_$j')\">
                    <div class='ar-work-image'>
                        <img src='img/shooting-jwd-web/$array_img_shooting_jwd_ai[$j]' loading='lazy' alt='$array_title_shooting_jwd_ai[$j] | Jam Web Division' title='$array_title_shooting_jwd_ai[$j] | Jam Web Division' >
                    </div>
                    <div class='ar-work-title c-white link-servizio-tit'>$array_title_shooting_jwd_ai[$j]</div>  
                </a>
            </div>
        ";
    }


    if ($detect->isMobile() or $detect->isTablet()) {
        // MOBILE & TABLET CODE
        $txt_nostri_settori = "";
        $scroll_arrows_resp = "scroll";
        $scroll_arrows_resp_serv = "scroll";

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'CriOS') !== false) {
                // User agent is Google Chrome
                $scroll_arrows_resp_serv = "arrows";
        }

        $blocco_servizi = "
            <div class='section'> 
                <div class='wrapper no-gap'> 
                    
                    $lista_servizi_col_mobile

                </div> 
            </div> 
        ";

        $blocco_serv_ai = "
            <div class='section bg-black'> 
                <div class='wrapper no-gap'> 
                    
                    $lista_servizi_col_mobile_ai

                </div> 
            </div> 
        ";
    }
    else {
        // DESKTOP CODE
        $txt_nostri_settori = "";
        $scroll_arrows_resp = "scroll";
        $scroll_arrows_resp_serv = "scroll";


        $blocco_servizi = "
            <div class='section'> 
                <div class='wrapper no-gap'> 
                    <div class='c-col-12 no-gap pl-15-mobile'> 
                        <div data-navigate='$scroll_arrows_resp_serv' class='a-recent-works-servizi light'> 
                            <div style='color: rgba(25,27,29,.2)' class='recent-works-bg-text'> 
                                $txt_nostri_settori
                            </div>
                            <!--Background Text-->

                            <!--Navigation (Don't Touch)-->
                            <div class='a-recent-works-nav'>
                                <div class='arw-prev'><i class='icofont-long-arrow-left'></i></div>
                                <div class='arw-next'><i class='icofont-long-arrow-right'></i></div>
                            </div>
                            <!--Navigation (Don't Touch)-->

                            <div class='recent-works-wrapper'>

                                $lista_servizi_img
                                
                            </div>

                        </div> 
                    </div> 
                </div> 
            </div> 
        ";

        $blocco_serv_ai = "
            <div class='section bg-black' style='padding: 100px 0px 0px 0px;'> 
                <div class='wrapper no-gap'> 
                    <div class='c-col-12 no-gap pl-15-mobile mb-105'> 
                        <div data-navigate='arrows' class='a-recent-works light'> 
                            <div style='color: rgba(25,27,29,.2)' class='recent-works-bg-text'> 
                                $txt_nostri_settori
                            </div>
                            <!--Background Text-->

                            <!--Navigation (Don't Touch)-->
                            <div class='a-recent-works-nav'>
                                <div class='arw-prev'><i class='icofont-long-arrow-left'></i></div>
                                <div class='arw-next'><i class='icofont-long-arrow-right'></i></div>
                            </div>
                            <!--Navigation (Don't Touch)-->

                            <div class='recent-works-wrapper'>

                                $lista_servizi_img_ai
                                                        
                            </div>

                        </div> 
                    </div> 
                </div> 
            </div>
        ";
    
    }


    // PROGETTO TESI INTAI.FM

    $cookie_css = "
        <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.9/dist/cookieconsent.css'  media='print' onload=\"this.media='all'\" />
    ";

    $cookie_js = "
        <script defer src='https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.9/dist/cookieconsent.js'></script>
        <script defer src='/cookieconsent/init-cookieconsent.js'></script>

        <!-- Google tag  -->
        <script async src=\"https://www.googletagmanager.com/gtag/js?id=GTM-PCXKVLN\"></script>
        <script type='text/plain' data-cookiecategory='analytics' defer>

            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-PCXKVLN');

        </script>

        <!-- Clarity  -->
        <script type='text/plain' data-cookiecategory='analytics' defer>

            (function(c,l,a,r,i,t,y){
                c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                t=l.createElement(r);t.async=1;t.src='https://www.clarity.ms/tag/'+i;
                y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
            })(window, document, 'clarity', 'script', 'bvsk67u7gz')

        </script>

        <!-- Facebook Pixel Code -->
        <script type='text/plain' data-cookiecategory='targeting' defer>

            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');

            //fbq('init', '754418132896978'); 
            fbq('init', '754418132896978', {'external_id': userId});
            //console.log(userId);
            fbq('track', 'PageView');


            //FB PARAMETER --> Aggiungo una volta che sono stati accettati i cookie
            // fbc: userFbc,
            // fbp: userFbp,
            // ipAddress: userIpAddress,
            // userAgent: clientUserAgent,

            setTimeout(
                function(){
                    var userFbc = '';
                    //IF PRESENT --> FBC è presente solo se è stata cliccata un ad prima di giungere sulla pagina

                    userFbc = getCookieValue('_fbc');
                    var userFbp = getCookieValue('_fbp');

                    var userIpAddress = '$clientIpAddress';
                    var clientUserAgent = '$clientUserAgent';

                    var updSessionData = {
                        sessionId: sessionId,
                        userId: userId,
                        fbc: userFbc,
                        fbp: userFbp,
                        client_ip_address: userIpAddress,
                        client_user_agent: clientUserAgent,

                    };

                    sendSessionData(updSessionData, 'updateSession');

                }, 500
            );

        </script>

        <noscript>
            <img height=\"1\" width=\"1\" src=\"https://www.facebook.com/tr?id=754418132896978&ev=PageView&noscript=1\"/>
        </noscript>

    ";


    
    // if($_SERVER['REMOTE_ADDR'] == "62.170.25.241" || $_SERVER['REMOTE_ADDR'] == "151.19.240.118")
    // {
    //     $style_intaim = "";
    // }
    // else
    // {
    //     $style_intaim = "
    //         .box-intaim-chat {
    //             display: none !important;
    //         }
    //     ";
    // }




    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset='utf-8'>
    
    <title><?= $title_seo ?></title>

    <meta name='author' content='Jam Web Division'>
    <meta name='description' content='<?= $description_seo ?>'>

    <meta name='viewport' content='width=device-width, initial-scale=1'>


    <link rel='preload' href='https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap' as='style' onload="this.onload=null;this.rel='stylesheet'">
	<noscript><link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap'></noscript>


    <link href='/css/plugins.css' rel='stylesheet'>
    <link href='/style-web-division.css' rel='stylesheet'>

    <link rel='canonical' href='https://www.jamcommunication.it/servizi-web-agency-firenze'>

    <link rel='apple-touch-icon' sizes='57x57' href='/icon/apple-icon-57x57.png'>
    <link rel='apple-touch-icon' sizes='60x60' href='/icon/apple-icon-60x60.png'>
    <link rel='apple-touch-icon' sizes='72x72' href='/icon/apple-icon-72x72.png'>
    <link rel='apple-touch-icon' sizes='76x76' href='/icon/apple-icon-76x76.png'>
    <link rel='apple-touch-icon' sizes='114x114' href='/icon/apple-icon-114x114.png'>
    <link rel='apple-touch-icon' sizes='120x120' href='/icon/apple-icon-120x120.png'>
    <link rel='apple-touch-icon' sizes='152x152' href='/icon/apple-icon-152x152.png'>
    <link rel='apple-touch-icon' sizes='180x180' href='/icon/apple-icon-180x180.png'>
    <link rel='icon' type='image/png' sizes='192x192'  href='/icon/android-icon-192x192.png'>
    <link rel='icon' type='image/png' sizes='32x32' href='/icon/favicon-32x32.png'>
    <link rel='icon' type='image/png' sizes='96x96' href='/icon/favicon-96x96.png'>
    <link rel='icon' type='image/png' sizes='16x16' href='/icon/favicon-16x16.png'>
    <meta name='msapplication-TileColor' content='#ffffff'>
    <meta name='msapplication-TileImage' content='/icon/ms-icon-144x144.png'>
    <meta name='theme-color' content='#ffffff'>

    <!-- Open Graph / Facebook -->
    <meta property='og:type' content='website'>
    <meta property='og:url' content='https://www.jamcommunication.it/servizi-web-agency-firenze'>
    <meta property='og:title' content='<?= $title_seo ?>'>
    <meta property='og:description' content='<?= $description_seo ?>'>
    <meta property='og:image' content='/icon/android-icon-192x192.png'>

    <!-- Twitter -->
    <meta property='twitter:card' content='summary_large_image'>
    <meta property='twitter:url' content='https://www.jamcommunication.it/servizi-web-agency-firenze'>
    <meta property='twitter:title' content='<?= $title_seo ?>'>
    <meta property='twitter:description' content='<?= $description_seo ?>'>
    <meta property='twitter:image' content='/icon/android-icon-192x192.png'>

    <?= $cookie_css ?>

    <style>

        #pjAcceptCookieBar {
            display: none;
        }

        .link-servizio-tit::after {
            content: "\ea5d";
            font-family: IcoFont;
            position: absolute;
            -webkit-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            transform: rotate(-45deg);
            margin-top: -8px;
        }

        .mb-60 {
            margin-bottom: 60px;
        }

        .ar-work-title {
            min-height: 150px;
        }
        .cursor-on {
            cursor: pointer;
        }

        .box-grid {
            height: 150px;
        }

        .mb-105 {
            margin-bottom: 105px;
        }

        .grid-title {
            font-size: 36px;
            font-weight: 700;
            height: 100%;
            width: 100%;
            padding: 0px !important;
        }

        .box-grid .a-button {
            height: 100%;
            width: 95%;
            padding: 20px 0px 0px 20px;
        }

        .arrow-grid {
            font-size: 35px;
            position: absolute !important;
            right: 10px;
            bottom: 10px;
        }


        .icon-contact {
            cursor: pointer;
        }

        .fix-checkbox {
            align-items: flex-start; 
            padding-top: 7px;
        }

        .icon-servizi {
            cursor: pointer;
        }
        
        .mr-30 {
            margin-right: 30px !important;
        }

        .br-30 {
            border-radius: 30px;
        }

        .mr-10 {
            margin-right: 10px !important;
        }

        

        .a-button {
            cursor: pointer;
        }

        .modal.open {
            transform: translateX(0px);
        }

        .modal {
            /* Update CSS with transition and transform rules */
            transition: transform 1s ease-in-out;
            transform: translateX(100%);
            position: fixed;
            z-index: 1000;
            padding: 200px 60px;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            overflow: auto;
            overflow-y: scroll;
            background-color: rgba(255, 255, 255);
        }

        .modal-content {
            margin: auto;
        }

        .bg-white-btn {
            background-color: #FFF !important;
            border: 1px solid #191b1d;
        }

        .btn-inverse-padding {
            padding: 20px 40px 20px 10px !important;

        }
        .alioth-services.style_2.white-line .service::after {
            background: white;
        }

        .fs-18 {
            font-size: 18px;
        }

        .white-popup {
            position: relative;
            background: #FFF;
            width:auto;
            max-width: 500px;
            margin: 90px auto;
        }

        .ser_tit_line {
            max-height: 70px;
        }

        .mfp-close {
            top: 15px;
            right: 15px;
        }

        .underlight-white {
            background-color: white;
            color: black;
        }

        .underlight-black {
            background-color: black;
            color: white;
        }

        .site-logo {
            background-color: black;
        }

        .italic {
            font-style: italic;
        }

        .service-faq {
            width: 100%;
        }

        .alioth-services.style_2 .service {
            width: 100%;
        }

        .alioth-services.style_2 .service-title {
            font-size: 1.5rem;
            padding: 10px 0px;
        }

        .alioth-services.style_2 .service-toggle {
            padding: 20px 0px;
        }
 
        .alioth-services.style_2 .service-wrap {
            margin-left: 0px;
        }

        .alioth-services.style_2 .service-cont {
            width: 90%;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .social-header {
            display: none;
        }

        .box-form-popup {
            background-color: white;
            padding: 20px;
            border-radius: 30px;
        }

        form label {
            position: relative;
        }

        form input {
            padding: 10px;
        }

        .only-mobile {
            display: none;
        }

        .only-desktop {
            display: block;
        }

        .service-cont {
            min-width: 950px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .a-button .fix-serv {
            display: inline-block !important;
            vertical-align: middle;
            margin-left: 20px;
            padding: 0px !important;
            float: right !important;
        }

        .a-button .fix-serv-2 {
            display: inline-block !important;
            vertical-align: middle;
            margin-right: 20px;
            margin-left: 10px;
            padding: 0px !important;
            float: left !important;
        }

        input[type=checkbox]
        {
            -webkit-appearance:checkbox;
        }

        .w-100 {
            width: 100%;
        }

        .fix-height .anim_line {
            height: 100px;
        }

        @media only screen and (max-width: 450px) {

            .fix-height .anim_line {
                height: unset;
            }

            .mr-5-m {
                margin-right: 5px !important;
            }

            .mr-10-m {
                margin-right: 10px;
            }

            .big-title-custom {
                font-size: 36px;
            }

            .a-button a {
                padding: 20px 10px 20px 20px !important;
            }

            .btn-inverse-padding {
                padding: 20px 20px 20px 10px !important
            }

            .a-button i {
                padding-right: 15px;
            }

            .ser_tit_line {
                max-height: 80px;
                font-size: 16px;
            }

            .fs-16-m {
                font-size: 16px;
            }

            .modal {
                padding: 100px 0px;
            }

            .service-cont {
                position: absolute;
                min-width: 350px;
            }

            .mt-20-m {
                margin-top: 20px;
            }

            .mb-5-m {
                margin-bottom: 20px;
            }

            .mb-0-m {
                margin-bottom: 0px;
            }

            .only-mobile {
                display: block;
            }

            .only-desktop {
                display: none;
            }

            .fs-35-m {
                font-size: 35px;
            }

            .fs-20-m {
                font-size: 20px;
            }

            .fs-18-m {
                font-size: 18px;
            }
        }
    </style>

    <link rel="stylesheet" href="intaim-chat.css">

    <style>
        <?= $style_intaim ?>

        .float {
            display: none;
        }
    </style>
</head>

<body data-barba="wrapper"  <?= $body_settings ?> >

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PCXKVLN"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>


    <?= $preloader ?>
    <?= $page_transitions ?>
    
    <?= $cursor ?>

    <?= $header ?>

    <!-- Page -->
    <div id="page" data-barba="container"> 
        <div id="content" class="page-content"> 


            <div class="section no-margin track-section" data-section='1'> 
                <div class="wrapper add-ml">
                    
                    <span class="a-empty-space hide_mobile" style="height: 215px"></span>
                    <span class="a-empty-space hide_desktop" style="height: 130px"></span> 
                    <?= $img_scritta_logo ?>
                    <span class="a-empty-space hide_desktop" style="height: 70px"></span> 
                    <div class="c-col-12 pl-0"> 
                        <div class="text-wrapper">
                            <?= $mx_pers_1 ?>
                            <h1 class="has-anim big-title-custom mt-40 resp-mt-0 fix-height" data-stagger="0.01" data-duration="1.2" data-delay="0" data-animation="charsUp">
                                Uno sguardo al futuro
                            </h1>
                            <h2 class="has-anim big-title thin-txt mt-40 maxw-950" data-stagger="0.01" data-duration="1.2" data-delay="0" data-animation="charsUp">
                                Trasformiamo la complessità del web in un'avventura reale ed affascinante.
                                <br><br>
                                La nostra mission è quella di guidare le aziende verso il successo digitale, 
                                offrendo soluzioni su misura che riflettano la loro unicità e rispondano ad esigenze specifiche. 
                            </h2>
                        </div> 
                    </div> 

                    <div class="c-col-8 pl-0 mb-0">
                        <!-- <img src='img/servizi-landing-jwd.jpg' alt='Jam Web Division | Aiutiamo a vendere sul web' title='Jam Web Division | Aiutiamo a vendere sul webn' loading='eager' class='img-fluid'  /> -->
                        <!-- <img src='img/foto-auc-hero-1.jpg' alt='Jam Web Division | Aiutiamo a vendere sul web' title='Jam Web Division | Aiutiamo a vendere sul webn' loading='eager' class='img-fluid'  /> -->
                        <img src='img/hero-jwd-new-corporate.webp' alt='Jam Web Division | Aiutiamo a vendere sul web' title='Jam Web Division | Aiutiamo a vendere sul webn' loading='lazy' class='img-fluid'  />
                        
                    </div>

                </div> 
            </div> 

            <div class="section no-margin track-section" data-section='2'> 
                <div class="wrapper-full mb-60 mb-25-m"> 

                    <div class="c-col-4 only-desktop">
                        <span class="a-empty-space" style="height: 30px"></span> 
                        <span data-color="black" data-anim="true" class="alioth-seperator"></span> 
                        <span class="a-empty-space" style="height: 30px"></span>
                    </div>

                    <div class="c-col-4">
                        <div class="text-wrapper text-center">

                            <div class="a-button style_1"> 
                                <a href="#form-landing-jwd" class="text-btn c-white popup-form">Contattaci</a> 
                                <i class="icofont-arrow-right icon-btn c-white icon-contact"></i> 
                            </div>

                        </div>
                    </div>

                    <div class="c-col-4 only-desktop">
                        <span class="a-empty-space" style="height: 30px"></span> 
                        <span data-color="black" data-anim="true" class="alioth-seperator"></span> 
                        <span class="a-empty-space" style="height: 30px"></span>
                    </div>
    
                </div>
            </div>

            <div class="section"> 

                <div class="wrapper ml-450 mt-20"> 
                    <div class="c-col-12 pl-0 track-section" data-section='3'>
                        <div class="text-wrapper">
                            <h2 class="has-anim h2-tradizione" data-stagger="0.1" data-duration="1.5" data-delay=".1" data-animation="linesUp">
                                Jam Web Division, una visione chiara:
                            </h2>

                            <h3 class="has-anim fs-175r p-tradizione maxw-950" data-stagger="0.05" data-duration="1.25" data-delay=".5" data-animation="linesUp">
                                Immagina il web come una grandiosa orchestra. 
                                Un concerto di possibilità dove ogni strumento - sito web, 
                                e-commerce, social network, campagne pubblicitarie,
                                motori di ricerca - suona la propria parte unica nella sinfonia digitale.
                                <br><br>
                                Come in un'orchestra, la maestria risiede non solo nel 
                                saper suonare bene il proprio strumento, ma nell'armonia, 
                                nell'ascolto e nell'interazione con gli altri. 
                                <br><br>
                                Ecco dove entriamo in gioco noi, Jam Web Division. 
                                Noi non ci limitiamo a suonare, siamo i direttori 
                                d'orchestra del tuo viaggio digitale. Ci occupiamo di 
                                accordare gli strumenti, coordinare i musicisti ed interpretare 
                                lo spartito in modo da emozionare il pubblico e 
                                chiedere il bis.
                                <br><br>
                                Ma non fermiamoci qui, il web è come la musica, viva, 
                                in continua evoluzione, capace di suscitare emozioni e 
                                creare connessioni. Come un direttore d'orchestra interpreta uno 
                                spartito, così noi interpretiamo il web, cogliendone le tendenze, 
                                le sfumature, le opportunità, per creare la melodia perfetta 
                                per il tuo brand.
                                <br><br>
                                Fatti guidare da noi in questa affascinante avventura.
                                <?= $mx_pers_4 ?>
                            </h3>

                        </div> 
                    </div>

                    <span class="a-empty-space hide_mobile" style="height: 20px"></span>
                    <span class="a-empty-space hide_desktop" style="height: 0px"></span> 

                    <!-- 
                        <div class="c-col-8 pl-0 track-section" data-section='4'>
                            <img src='img/shooting-jwd-web/team-jam-web-division.webp' alt='Jam Web Division | Aiutiamo a vendere sul web' title='Jam Web Division | Aiutiamo a vendere sul webn' loading='eager' class='img-fluid'  />
                            
                        </div>

                        <div class="c-col-12 pl-0 mb-0 track-section" data-section='5'>
                            <div class="text-wrapper">

                                <h3 class="has-anim fs-175r p-tradizione maxw-950" data-stagger="0.05" data-duration="1.25" data-delay=".5" data-animation="linesUp">
                                    <b class='italic'>"Con il mio giovane Team..."</b> 
                                    <br>
                                    Condividiamo i valori che guidano la nostra SARTORIA DIGITALE: etica, innovazione e personalizzazione. 
                                </h3> 

                            </div> 
                        </div> 
                    -->

                </div>

                <div class="wrapper ml-450 track-section" data-section='6'> 
                    <div class="c-col-12 pl-0">
                        <span class="a-empty-space hide_desktop" style="height: 45px"></span>
                        <div class="text-wrapper">
                            <h2 class="has-anim h2-tradizione maxw-950" data-stagger="0.1" data-duration="1.5" data-delay=".1" data-animation="linesUp">
                                L'arte di far crescere il tuo business. 
                            </h2>
                            <?= $mx_pers_2 ?>
                            
                        </div>
                    </div>
                </div>

                <!-- # Servizi -->
                <?= $blocco_servizi ?>


                <div class="section bg-black mb-0 track-section" style="padding: 100px 0px 0px 0px;" data-section='15'>
               
                    <div class="wrapper ml-450 mb-0 mt-20" > 
                        <div class="c-col-12 pl-0">
                            <div class="text-wrapper">
                                <h2 class="has-anim big-title thin-txt no-br-mobile c-white" data-stagger="0.1" data-duration="1" data-delay=".1" data-animation="linesUp">
                                    Jam Web Division amplia ulteriormente la sua offerta 
                                    per supportare le aziende nella gestione e ottimizzazione delle loro attività, 
                                    sfruttando al meglio le potenzialità dell'intelligenza artificiale.     
                                </h2>
                            </div> 
                        </div>
                    </div>

                </div>


                <?= $blocco_serv_ai ?> 

                <div class="wrapper ml-450 mb-0 mt-20 track-section" data-section='18'> 

                    <span class="a-empty-space hide_desktop" style="height: 90px"></span> 

                    <div class="c-col-12 pl-0 mb-20">
                        <div class="text-wrapper">

                            <?= $mx_pers_3 ?>

                            <div class="a-button style_1"> 
                                <a href="#form-landing-jwd" class="text-btn c-white popup-form">Contattaci</a> 
                                <i class="icofont-arrow-right icon-btn c-white icon-contact"></i> 
                            </div>

                        </div> 
                    </div>
                </div>
            </div>

            <div class="section no-margin"> 
                <div class="wrapper ml-450"> 

                    <span class="a-empty-space hide_desktop" style="height: 120px"></span> 

                    <div class="c-col-8 pl-0 mb-0 track-section" data-section='19'>
                        <!-- <img src='img/servizi-landing-jwd.jpg' alt='Jam Web Division | Aiutiamo a vendere sul web' title='Jam Web Division | Aiutiamo a vendere sul webn' loading='eager' class='img-fluid'  /> -->
                        <img src='img/shooting-jwd-web/consulenza-strategica-marketing-jam-web-division.webp' alt='Jam Web Division | Aiutiamo a vendere sul web' title='Jam Web Division | Aiutiamo a vendere sul webn' loading='lazy' class='img-fluid'  />
                        
                    </div>

                    <span class="a-empty-space hide_mobile" style="height: 120px"></span>
                    <span class="a-empty-space hide_desktop" style="height: 120px"></span> 

                    <div class="c-col-12 pl-0">
                        <div class="text-wrapper track-section" data-section='20'>
                            <h2 class="has-anim h2-tradizione" data-stagger="0.05" data-duration="1.25" data-delay=".5" data-animation="linesUp">
                                FAQ
                            </h2>
                            <h3 class="has-anim fs-175r p-tradizione" data-stagger="0.05" data-duration="1.25" data-delay=".5" data-animation="linesUp">
                                <?= $mx_pers_5 ?>
                            </h3>
                        </div>
                    </div>
                    <div class="c-col-12 pl-0"> 
                        
                        <div data-anim="false" class="alioth-services style_2"> 
                            <div class="services"> 

                                <?= $lista_faq ?>

                            </div>
                        </div>
                    </div>

                    <div class="c-col-12 pl-0">
                        <div class="text-wrapper track-section" data-section='32'>
                            <h3 class="has-anim fs-175r" data-stagger="0.05" data-duration="1.25" data-delay=".5" data-animation="linesUp">
                                Come posso collaborare con Jam Web Division?
                            </h3>
                            <p class='p-tradizione maxw-950'>
                                Entrare a far parte della nostra avventura è semplice! <br>
                                Contattaci per una piacevole chiacchierata e scopri come possiamo aiutarti a far crescere il tuo business. <br>
                                Siamo pronti ad accoglierti nel nostro affascinante mondo della Sartoria Digitale.
                                <br><br>
                                <div class='a-button style_1'> 
                                    <a href='#form-landing-jwd' class='text-btn c-white popup-form'>Contattaci</a> 
                                    <i class='icofont-arrow-right icon-btn c-white icon-contact'></i> 
                                </div>
                            </p>

                        </div>
                    </div>

                </div>
            </div>

            <form id='form-landing-jwd' method="POST" class='white-popup mfp-hide track-section' action="contact-landing-jwd.php"  data-section='33'>
                <div class="box-form-popup">
                    <div class="wrapper-small" style='margin-bottom: 20px;'>
                        <div class="c-col-12">
                            <h3 class="fs-175r p-tradizione">
                                Ti richiamiamo noi!
                            </h3>
                        </div>
                        <div class="c-col-12 mb-0">
                            <label> Nome e Cognome </label>
                        </div>
                        <div class="c-col-12">
                            <input type="text" name='nome' id='name-landing-jwd' required autocomplete="off" />
                        </div>
                        <div class="c-col-12 mb-0">
                            <label> Azienda </label>
                        </div>
                        <div class="c-col-12">
                            <input type="text" name='azienda' id='azienda-landing-jwd' required autocomplete="off" />
                        </div>
                        <div class="c-col-12 mb-0">
                            <label> Telefono </label>
                        </div>
                        <div class="c-col-12">
                            <input type="tel" name='tel' id='telefono-landing-jwd' required autocomplete="off" />
                        </div>
                        <div class="c-col-12 mb-0">
                            <label> E-mail </label>
                        </div>
                        <div class="c-col-12">
                            <input type="email" name='email' id='email-landing-jwd' required autocomplete="off" />
                        </div>
                        <div class="c-col-12">
                            <div class="d-flex m30-0 h-50">
                                <div class="max-w-15 d-flex">
                                    <input class="checkbox1" type="checkbox" id='privacy-landing-jwd' name='policy' required/>
                                </div>
                                <div class="max-w-255 d-flex ml-5">
                                    <p class="p-policy">
                                        Ho preso visione della <a class='ml-5' href='https://www.jamcommunication.it/privacy-policy.php'>Privacy Policy</a>
                                    </p>
                                </div>  
                            </div> 
                        </div>

                        <div class="c-col-12">
                            <div class="d-flex m30-0 h-50">
                                <div class="max-w-15 d-flex fix-checkbox" >
                                    <input class="checkbox1" type="checkbox" id='trattamento-landing-jwd' name='trattamento' required />
                                </div>
                                <div class="max-w-255 d-flex ml-5">
                                    <p class="p-policy">
                                        Acconsento al Trattamento dei miei Dati Personali per Attività Di Marketing secondo Art. 13 del Regolamento Europeo 2016/679
                                    </p>
                                </div>  
                            </div> 
                        </div>
                    </div> 


                    <div class="send-wrap">
                        <button type="submit" class="button button-block float-r br-30 w-100">Invia <i class="icofont-arrow-right icon-btn c-white"></i> </button>
                    </div> 

                </div>
            </form>

            <?= $lista_modal_servizi ?>

            <?= $lista_modal_servizi_ai ?>


            <!-- INTAIM -->
            <div class="box-intaim-chat" id="box-intaim">
                <button class="button-intaim-chat" id="btn-intaim">
                    <div class="button-intaim-chat__content">
                        <p class="button-intaim-chat__text" id="btn-txt-intaim">
                            <!-- 
                                Ciao! Sono CarolAIna, l'intelligenza artificiale di Jam Web Division. 
                                <br> Clicca qui per chattare con me!
                            -->
                            <span id="type-btn-txt-intaim"></span>
                        </p>
                    </div>
                </button>

                <div class="chat-containter-intaim container"> 
                    <div class="box-curtains">
                        <div class="curtains d-flex">
                            <input type="range" class="slideToUnlock" value="0" max="100">
                        </div>
                        <div class="curtains_2"></div>

                        <div class="box-intaim-conversation">
                            <div class="msg-div msg-bot c-col-7">
                                <p><span id="type-first_msg_intaim"></span></p>
                            </div>
                            
                            <!-- 
                                <div class="msg-div msg-user col-7">
                                    <p>
                                        Messaggio USER
                                    </p>
                                </div> 
                            -->

                        </div>
                        <div class="box-intaim-actions row justify-content-between no-gutters">
                            <div class="input-txt-intaim c-col-9">
                                <input id="input-msg" type="text" placeholder="Scrivi il tuo messaggio..." disabled>
                            </div>
                            <div class="send-btn-intaim c-col-2">
                                <a class="button-intaim-chat__text" id="btn-send-msg">
                                    <img src="/img/send-icon-intaim.png" class="img-fluid icon-send-chat-intaim">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <?= $footer_jwd ?>

    <?= $scripts ?>

    <script>
        function openModal(mod_name) {
            var modal = document.getElementById(mod_name);

            // Add open class to make visible and trigger animation
            modal.classList.add('open');
        }

        function closeModal(mod_name) {
            var modal = document.getElementById(mod_name);
            // Remove open class to hide and trigger animation
            modal.classList.remove('open');
        }
    </script>

    <script>
        $('.popup-form').on('click', function(){
            $('.popup-form').magnificPopup({
                // other options

            });
        });

        $(document).on('click',".popup-form",function(){
            $('.popup-form').magnificPopup({
                // other options

            });
        });
    </script>

    <script>
        $(document).on('click','.icon-contact',function(){
            $.magnificPopup.open({
                items: {
                    src: '#form-landing-jwd'
                },
                type: 'inline'
            });
        });

        $(window).resize(function() {
            var width = $(window).width();
            if (width < 767){                
                $('.service').attr("data-height", "850");
            }
        });

        $(window).on('load',function() {
            var width = $(window).width();
            if (width < 767){                
                $('.service').attr("data-height", "850");
            }
        });
    </script>

    <script>
        // setTimeout( function() {
        //     fbq('trackCustom', 'after120sec');
        // }, 120000)
    </script>

    <script>
        const getCookieValue = (name) => (
            document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || ''
        )
    </script>

    <!-- $script_aweber_landing_jwd -->

    <script src="https://cdn.jsdelivr.net/npm/navigator.sendbeacon"></script>
    <script src='/intai-main.js' eager></script>

    <?= $cookie_js ?>


    <!-- INTAIM -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <script>

        setTimeout(function(){
            sessionId = localStorage.getItem("sessionId");
            console.log("sessionId");
            console.log(sessionId);
        }, 500);
        

        var utente_verificato = false;

        //slide to unlock feature
        document.querySelector("input[type=\"range\"]").onpointerup = function() {

            var theRange = this.value;
            console.log(theRange);
            if(theRange > 80) {

                unlock();

            } else {
                document.init = setInterval(function() {
                    if(document.querySelector("input[type=\"range\"]").value != 0) {
                        document.querySelector("input[type=\"range\"]").value = theRange--;
                    }
                }, 1);
            }
        }

        document.querySelector("input[type=\"range\"]").onclick = function() {

            var theRange = this.value;
            console.log(theRange);
            if(theRange > 80) {

                unlock();

            } else {
                document.init = setInterval(function() {
                    if(document.querySelector("input[type=\"range\"]").value != 0) {
                        document.querySelector("input[type=\"range\"]").value = theRange--;
                    }
                }, 1);
            }
        }

        document.querySelector("input[type=\"range\"]").onpointerdown = function() {
                clearInterval(document.init);
        }

        function unlock() {
            
            //sbloccato
            $(".curtains").addClass("closed");
            $(".curtains_2").addClass("closed");

            document.querySelector("input[type=\"range\"]").style.opacity = "0";

            var typed_first_msg_intaim = new Typed('#type-first_msg_intaim', {
                strings: ["Ciao! Mi chiamo CarolAIna, l'Intelligenza Artificiale di Jam. <br> Come posso aiutarti? "],
                typeSpeed: 25,
            });

            $('#input-msg').prop('disabled', false);
            utente_verificato = true;
            
        }

        var typed_btn_intaim = new Typed('#type-btn-txt-intaim', {
            strings: ["Hey, sono l'Intelligenza Artificiale di Jam. <br> Clicca qui per chattare con me!"],
            typeSpeed: 30,
            startDelay: 800
        });

        

        var chat_open = false;
        var first_open_chat = false;

        $('#btn-intaim').on('click', function(){
            chat_open = !chat_open;
            $('#box-intaim').toggleClass("opened-chat");

            if(chat_open)
            {
                // $('#btn-txt-intaim').html("Chiudi");
                var typed_btn_intaim_close = new Typed('#type-btn-txt-intaim', {
                    strings: ["Chiudi"],
                    typeSpeed: 80,
                });
            }
            else
            {
                // $('#btn-txt-intaim').html("Torna alla chat");
                var typed_btn_intaim_close = new Typed('#type-btn-txt-intaim', {
                    strings: ["Torna alla chat"],
                    typeSpeed: 80,
                });
            }

            first_open_chat = true;
            
        });

        var open_check = 1;

        if(open_check == <?= $open_chat_bool ?>)
        {
            $('#btn-intaim').click();
            console.log("-- CLICK FATTO --");
        }


        var id_bot_msg = 0;
        var next_id_bot_msg = "";



        $('#btn-send-msg').on('click', function(){

            if(utente_verificato) 
            {
                id_bot_msg++;

                var input_user = $('#input-msg').val();
                $('#input-msg').val("");

                var user_msg = "<div class='msg-div msg-user col-7'><p>" + input_user + "</p></div>";

                $('.box-intaim-conversation').append(user_msg);

                next_id_bot_msg = "type_bot_msg"+id_bot_msg;

                // var bot_msg_loading = "<div class='msg-div msg-bot col-7'><p><span id='type-first_msg_intaim'></span></p></div>";
                var bot_msg_loading = "<div class='msg-div msg-bot col-7'><p><span id='"+ next_id_bot_msg +"'></span></p></div>";

                $('.box-intaim-conversation').append(bot_msg_loading);

                var typed_bot_msg = new Typed("#"+next_id_bot_msg, {
                    strings: ["Caricamento..."],
                    typeSpeed: 25,
                });

                $('#input-msg').prop('disabled', true);


                // $('.box-intaim-conversation').scrollTo('99999');
                $('.box-intaim-conversation').animate({ scrollTop: $('.box-intaim-conversation').height() }, 800);

                var risposta_mistral = "";

                $.ajax({
                    method: "POST",
                    url: "mistral-api.php",
                    data: { 
                        check: "prod", 
                        id_session: sessionId, 
                        input_user: input_user 
                    }
                })
                .done(function( msg ) {
                    risposta_mistral = msg;

                    typed_bot_msg.strings = [""+risposta_mistral];
                    typed_bot_msg.reset();

                    $('#input-msg').prop('disabled', false);
                });


                var get_fbc = getCookieValue("_fbc");
                var get_fbp = getCookieValue("_fbp");

                $.ajax({
                    method: "POST",
                    url: "fb-conversion-api-intaim-chat.php",
                    data: { 
                        fbc: get_fbc, 
                        fbp: get_fbp 
                    }
                })
                .done(function( msg ) {

                    console.log(get_fbc);
                    console.log(get_fbp);
                    console.log(msg);
                });

            }
            else
            {
                console.log("utente non verificato");
            }

            
        });
        
        $(document).keypress(function (e) {
            if (e.which == 13) {
                $('#btn-send-msg').click();
            }
        });


    </script>


    

</body>

</html>
