
var userId;

var sessionId;

if (localStorage.getItem('userId')) {
    userId = localStorage.getItem('userId');
} else {
    // Genera un nuovo ID unico
    userId = 'usr_' + Math.random().toString(36).substr(2, 9);
    localStorage.setItem('userId', userId);
}

var sessionStart;

$(document).ready(function() {

    // Inizia la sessione dell'utente
    sessionId = generateSessionId();
    localStorage.setItem('sessionId', sessionId);
    sessionStart = Date.now();
    var deviceType = getDeviceType(); // Funzione che rileva il tipo di dispositivo

    

    // Salva i dati iniziali della sessione
    var sessionData = {
        sessionId: sessionId,
        userId: userId,

        //FB PARAMETER --> Aggiungo una volta che sono stati accettati i cookie
        // fbc: userFbc,
        // fbp: userFbp,
        // ipAddress: userIpAddress,
        // userAgent: clientUserAgent,

        startTime: sessionStart,
        deviceType: deviceType,
    };


    console.log('dati di sessione pronti:', sessionData);

    sendSessionData(sessionData, 'startSession');

  
  
    // Tracciamento dei click sulle sezioni
    $('.track-section').on('click', function() {
      var sectionId = $(this).data('section');
      var timestamp = Date.now();
      
      sendData({ type: 'click', userId: userId, sessionId: sessionId,  section: sectionId, time: timestamp,  timeSpent: 0 });
    });
  
    // Tracciamento dello scroll e del tempo trascorso nelle sezioni
    var sectionViewStart = {};
    $('.track-section').on('mouseenter', function() {
        
      var sectionId = $(this).data('section');
      sectionViewStart[sectionId] = new Date();
    }).on('mouseleave', function() {
      var sectionId = $(this).data('section');
      var startTime = sectionViewStart[sectionId];
      if (startTime) {
        var timestamp = Date.now();
        var endTime = new Date();
        var timeSpent = endTime - startTime; // tempo trascorso in millisecondi
  
        sendData({ type: 'view', userId: userId, sessionId: sessionId, section: sectionId, time: timestamp, timeSpent: timeSpent });
      }
    });
  
});


function sendData(data) {

    data.userId = userId;

    $.ajax({
        type: 'POST',
        url: '/intai-endpoint.php', 
        data: JSON.stringify(data),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(response) {
            console.log('sendData - success:', response);
        },
        error: function(error) {
            console.error('sendData - Errore nell\'invio dei dati:', error);
        }
    });
}

function endSessionProcedure() {
    var sessionEnd = Date.now();
    var currentSessionId = localStorage.getItem('sessionId');

    var sessionData = {
        userId: userId,
        sessionId: currentSessionId,
        endTime: sessionEnd,
        type: 'endSession'
    };

    console.log("pt1 - ENDSESSION");

    // Invia i dati di fine sessione al server
    //sendSessionDataSYNC(sessionData, 'endSession');
    navigator.sendBeacon('/intai-session-endpoint.php', JSON.stringify(sessionData));

    console.log("pt2 - ENDSESSION");
    
}

//window.onbeforeunload = endSessionProcedure();

$(window).bind('beforeunload', function(){
    endSessionProcedure();
    console.log("bind");
});

$(window).on('beforeunload', function ()
{
    //this will work only for Chrome
    endSessionProcedure();
    console.log("before");
});

$(window).on("unload", function ()
{
    //this will work for other browsers
    endSessionProcedure();
    console.log("unload");
});



function sendSessionData(data, type) {

    data.type = type; // Aggiungi il tipo di azione (startSession / updateSession / endSession)

    $.ajax({
        type: 'POST',
        url: '/intai-session-endpoint.php', 
        data: JSON.stringify(data),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(response) {
        console.log('sendSessionData - success:', response);
        },
        error: function(error) {
        console.error('sendSessionData - Errore nell\'invio dei dati:', error);
        console.error('Tipo:', type);
        console.error('Dati:', data);
        }
    });

}

function sendSessionDataSYNC(data, type) {

    data.type = type; // Aggiungi il tipo di azione (startSession / updateSession / endSession)

    $.ajax({
        type: 'POST',
        async: false,
        url: '/intai-session-endpoint.php', 
        data: JSON.stringify(data),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(response) {
            console.log('sendSessionData - success:', response);
            console.log('Tipo:', type);
            console.log('Dati:', data);
        },
        error: function(error) {
            console.error('sendSessionData - Errore nell\'invio dei dati:', error);
            console.error('Tipo:', type);
            console.error('Dati:', data);
            console.error('Errore:', error);
        }
    });

    

}

// Funzione per determinare il tipo di dispositivo
function getDeviceType() {
    var ua = navigator.userAgent;
    if (/mobile/i.test(ua)) return 'Mobile';
    else if (/tablet/i.test(ua)) return 'Tablet';
    else return 'Desktop';
}

// Funzione per generare un ID di sessione univoco
function generateSessionId() {
    return 'sess-' + Math.random().toString(36).substring(2) + '-' + Date.now();
}