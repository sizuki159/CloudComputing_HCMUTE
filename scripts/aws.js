const aws_access_key_id = "ASIA327DRVIHXF2ZQWKH";
const aws_secret_access_key = "Zs5x1tD+feme75AIbPjuxJ3miR9hmfjMn8pp/Nu3";
const aws_session_token = "FwoGZXIvYXdzEEAaDA4VjSMigHaJUQ6eJCLPAZV0duE/s9F+SW6yv+2Crh+c4lN2mGtmJYG5x6RlRK/rZpNsHMONRHmYh/dD6h0ukE85s5fHiL7Fww+RI1SlB4jTeqYmqxRsA+jAeXPCcmtPIIP7LdRDxJzEtHSymkMXln5ctm71CTGRhZ6D/sr4sHUaI3xT1qQxkUcRdlVD0YJo3d6IzZ0ChQqjc6TpZr8qcOaKIh8pOEsn5UyhmnlWxo8pz/i1OD/esO3AfFqJTd75HdeoO70BPjmY+U3JCu76um2T4gfH9/G2PpfDZOFoPSjys8ucBjIthRR08XPljwLcBa+SuGDC8K/rsnmBOplR+3FMPaDOQU/4NCLWuBd8zweQOZEQ";

AWS.config.region = 'us-east-1';
AWS.config.update({accessKeyId: aws_access_key_id, secretAccessKey: aws_secret_access_key, sessionToken: aws_session_token});
var translate = new AWS.Translate({region: AWS.config.region});


const titleContent = document.getElementById('title-content')
const mainContent = document.getElementById('main-content')

const convertTextToAudio = (voiceID) => {
    if(voiceID == null){
        alert('Dịch nội dung thành công, nhưng ngôn ngữ này hiện tại Amazon Polly chưa hỗ trợ chuyển sang giọng nói!')
        return;
    }

    var speechParams = {
        OutputFormat: "mp3",
        SampleRate: "16000",
        Text: mainContent.innerText,
        TextType: "text",
        VoiceId: voiceID
    };

    var polly = new AWS.Polly({apiVersion: '2016-06-10'});
    var signer = new AWS.Polly.Presigner(speechParams, polly)

    signer.getSynthesizeSpeechUrl(speechParams, function(error, url) {
        if (error) {
            alert(error);
        } else {
            document.getElementById('audioSource').src = url;
            document.getElementById('audioPlayback').load();
        }
    });
}

const translateContent = (targetLanguage) => {

    if(!targetLanguage) {
        alert("targetLanguage is error");
        return;
    }

    if (!mainContent.innerText) {
        alert("Text is not recognized");
    }

    var params = {
        Text: mainContent.innerText,
        SourceLanguageCode: "auto",
        TargetLanguageCode: targetLanguage
    };

    translate.translateText(params, function(err, data) {
        if (err) {
            console.log(err, err.stack);
            alert("Error calling Amazon Translate. " + err.message);
            return;
        }
        if (data) {
            mainContent.innerText = data.TranslatedText;
            convertTextToAudio(convertTargetLanguageToVoiceID(targetLanguage));
        }
    });

    params.Text = titleContent.innerText;
    translate.translateText(params, function(err, data) {
        if (data) {
            titleContent.innerText = data.TranslatedText;
        }
    });
}


const convertTargetLanguageToVoiceID = (targetLanguage) => {
    let voiceId = null
    switch (targetLanguage) {
        case "ar":
            voiceId = "Zeina";
            break;
        case "da":
            voiceId = "Mads";
            break;
        case "nl":
            voiceId = "Ruben";
            break;
        case "de":
            voiceId = "Marlene";
            break;
        case "zh":
            voiceId = "Zhiyu";
            break;
        case "en":
            voiceId = "Joanna";
            break;
        case "es":
            voiceId = "Penelope";
            break;
        case "fr":
            voiceId = "Celine";
            break;
        case "pt":
            voiceId = "Vitoria";
            break;
        case "ja":
            voiceId = "Takumi";
            break;
        case "ko":
            voiceId = "Seoyeon";
            break;
        case "ru":
            voiceId = "Maxim";
            break;
        default:
            voiceId = null;
            break;
    }

    return voiceId;
}

