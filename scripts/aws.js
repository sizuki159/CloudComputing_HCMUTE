const aws_access_key_id = "ASIA327DRVIHQWN5JY62";
const aws_secret_access_key = "Sk0x9yhWyMVa1cxw8t8gJVcoDOUbHFSQV37fC7Y3";
const aws_session_token = "FwoGZXIvYXdzEPb//////////wEaDE+7CIvp/2h5kwXTSyLPAePRh4SdWy1xL8YJqtOpi4BeDa8R+QbkaSwhHgnPH1HtlDs26iHOsJWHdPSROxdOzRuHTR127yfXBk//919xbA+GzRnY6qvQMFfkQ6f36r/FqXoIPtjLQhKpvNjwfzZV5AEGyCZSSq3+n/3yJp98al8BNJ3d5mqGYp1UfSJVY3Qy0GTS3jdHs07PTlx876b6bAlI9WThIv7ghGPIePx4ucgrnSArfsGQoinfn0VYXFsZIDRLa6vDlZeM6LHcTTFiukbKs5Os7R8xKfan57/CTCjahrucBjItbco7vRrYssbjsl3iXuxc6kMDBXa0rVLDM1Om+B30gpu03PFNtJIO+YICnrW9";

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

