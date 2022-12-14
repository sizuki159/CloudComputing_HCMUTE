const aws_access_key_id = "ASIA327DRVIH5XPPEZPR";
const aws_secret_access_key = "/OXd6G49dkVjMj6tUYKMo3CX/hgkXz3DLEAI0HYI";
const aws_session_token = "FwoGZXIvYXdzEBYaDMgIt5u3I6S916eltSLPASyjcq0Oq3JKbXMnS2pcSNLX8fHcPSjZcybJPhpliOXEOtqe/IOlKfF3A10qjM4AtwJyeBM4oc2RRuBW9BnIYGmWakZIHEBbXfu/RM5KxGXTfyyTGiHl/g8ZbmCrGTfhPNAQ5HlsiZkBQ6hQJM4tZXpw3pVwwxNipeWMyBCmMi0TGo/MkSo1k72tBHnlcO10aO9B4J14B24gEatsMxnJe5/6WwGS7pMZP9e/L5c+QHwDdERcmEmz3Am3ayKIsFOHBkUhpY4Rbh2rCWqo7JtfTiiIqPqcBjItvXFKwgiff6v56K5nQ6JVdJPA3NlCJ49pPzFjljpfER7WnZNEYkRh/RlDI+Io";

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

