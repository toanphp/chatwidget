
// "use strict"

// module.exports= class ChatWidgets() {

    var pageName= "Serenity Dental Clinic";
    var avatarUrl= "https://graph.facebook.com/885764481507624/picture?type=large";

        window.onload = function() {
            showWidget();
            // alert('da tai xong');
            document.getElementById('close-chatbox').onclick=function() {
                toggleChat('chat-box');
            };
            document.getElementById('chat-head').onclick=function() {
                toggleChat('chat-box');
            };
        }
    


        


    function showWidget() 
    {
        var messengerify= document.createElement('div');
        var chatBox= document.createElement('div');
        var widgetHeader= document.createElement('div');
        var avatar= document.createElement('div');
        var avatarImg= document.createElement('img');
        var header= document.createElement('div');
        var headerName= document.createElement('p'); 
        var headerNameText= document.createTextNode(pageName); 
        var chatOnFb= document.createElement('div'); 
        var chatOnFbImg= document.createElement('img'); 
        var closeChatbox= document.createElement('div'); 
        var closeChatbox1= document.createElement('div'); 
        var closeChatbox2= document.createElement('div'); 
        var separate= document.createElement('img');
        var chatContent= document.createElement('iframe');
        var chatContentCenter= document.createElement('center');
        var chatContentCenterLink= document.createElement('a');
        var chatContentCenterLinkText= document.createTextNode('Powered by Messengerify');
        var widgetButton= document.createElement('div');
        var welcomeMessages= document.createElement('div');
        var closeMessage= document.createElement('div');
        var closeMessage1= document.createElement('div');
        var closeMessage2= document.createElement('div');
        var welcomeMessage1= document.createElement('p');
        var welcomeMessage1Text= document.createTextNode('Hi there!');
        var welcomeMessage2= document.createElement('p');
        var welcomeMessage2Text= document.createTextNode('Is there anything I can help you with today?');
        var chatHead= document.createElement('div');
        var chatHeadStatus= document.createElement('div');
        var chatHeadAvatar= document.createElement('img');


        document.getElementsByTagName('body')[0].appendChild(messengerify);

        messengerify.style= "box-sizing: border-box;z-index:10000000000; font-family: sans-serif !important;vertical-align: baseline; max-width: 300px; position: fixed; bottom: 25px; right: 25px; font-style: normal; font-variant: normal; font-weight: normal; font-size: normal; line-height: normal; margin: 0; padding: 0; border: 0;";
        messengerify.appendChild(chatBox);
            chatBox.setAttribute('id', 'chat-box');
            chatBox.style= "display: none; opacity: 0; transition: all 0.4s ease; line-height: normal; font-style: normal; font-weight: normal; font-variant-ligatures: normal; font-variant-caps: normal; vertical-align: baseline; border-radius: 10px; height: 353px; box-shadow: rgba(0, 0, 0, 0.1) 2px 4px 14px 0px; background-color: white; margin: 0px; padding: 0px; border: 0px; overflow: hidden;";
            chatBox.appendChild(widgetHeader);
                widgetHeader.style="box-sizing: border-box;font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; border-top-right-radius: 10px; border-top-left-radius: 10px; position: relative; height: 122px; background-color: #3ADF70; margin: 0; padding: 22px 0 0; border: 0;";
                widgetHeader.appendChild(avatar);
                    avatar.style="box-sizing: border-box;font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; width: 74px; float: left; margin: 0; padding: 0 0 0 20px; border: 0;";
                    avatar.appendChild(avatarImg);
                        avatarImg.setAttribute('src', avatarUrl);
                        avatarImg.style="box-sizing: border-box;background: white; font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; width: 50px; height: 50px; border-radius: 50%; margin: 0; padding: 0; border: 2px solid white;";
                widgetHeader.appendChild(header);
                    header.style= "box-sizing: border-box;font-size: 18px; line-height: normal; font-style: normal; font-weight: 700; font-variant: normal; vertical-align: baseline; width: 180px; float: left; color: white; margin: 0; padding: 0 0 0 15px; border: 0;";
                    header.appendChild(headerName);
                        headerName.style="font-family: sans-serif; font-size: 18px !important; line-height: 21px !important; width: 180px; white-space: nowrap;overflow: hidden !important;text-overflow: ellipsis;min-height: 21px;box-sizing: border-box;color:white !important;font-size: normal; border: 0; font-style: normal; font-variant: normal; padding: 0; line-height: normal; margin: 0; font-weight: normal; vertical-align: baseline;";
                        headerName.appendChild(headerNameText);
                    header.appendChild(chatOnFb);
                        chatOnFb.style="box-sizing: border-box;cursor: pointer; font-size: normal; border: 0; font-style: normal; font-variant: normal; padding: 0; line-height: normal; margin: 0; font-weight: normal; vertical-align: baseline;";
                        chatOnFb.appendChild(chatOnFbImg);
                            chatOnFbImg.style="font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; width: 150px; margin: 0; padding: 5px 0 0 !important; border: 0;";
                            chatOnFbImg.setAttribute('src', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALUAAAAkCAMAAAD4t4t9AAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAwUExURQgICMHBwV1dXTk5Ofb29oCAgM/Pz5iYmPz8/NnZ2fHx8eTk5Ovr666urgAAAP///z6RUyIAAAAPdFJOU0CRVkvnZKFx9K7av82BBl/UOqAAAAKcSURBVFjD7ZnbcuMgDIYBIRCn1fu/7UrCdXDSOunN7njG/7Spa0vw6QB4Wvfnj7uaBPl60O6SzLdu3bp167LCMfCnZyHIx2jhN+OV8nILPhsAfKuxNg/vmSuL+vfDAjf5TJx/Qx3jayCMHzAX4ikqb7gDccq5cISfqUOGf0AdKj9Uz4vTeeiPZNGN5NEKhS4nqRN4rnKNPsg3wEhqO8zBW/qz90sZNnehRu/D8jx3Tv7LKi+T+KUZVmjBPg1weRyimktTIicdosuFKFmHJB5aP7+lEuSpg84xcocn9xi9XMTgoHKVL3BNn6wZbTpz6iudn73x1STsT6iHQO2VZQ/YxRyZOmLksPR1YkphcFypm9ZpmMnmHnpEFynm0HTaFJQmrR0iWRcruRd0EokhH1I9UGOnN8n2j5jm9IGkvuairCu1hhdpoQ6Tt3GY7mWPHrVe9iuADbFTo0brgEi8dSn52aAiS7LEESolvaYT6rzPpT0wY4Y5ow64UmfL1EItma+iONOV9vnNwEJKRBSVc6fesiSRzpjHnjUjlV0BYTbRGbUjgm1D3QaM7D6kzty9KRyrtlPbrXCg3jqyv1K3rTNozA5v7rRFdDVBI5x9kW0RnlFLMcxN6mzb5bYtTnfMC3Uj90w9+wJlfTxT5337mAvy/IhoHEuJOkST3ElN8UBNctIdqQv3USiSVqdnLF/zFtklpSPxQS1rAUcksUzcS9760KzyC7X4r0pvdncvq7aar66Cuq8kWygyVIUjtbZdR8ueusZ9WnNfcw1S9TjUU3YG2uy8WMXsXqkPG3b64Ch9bNkvhyB8cyyaFTzeU352t/cPuxme3m2+W2I7c0N3FQU5ooKclv537w//Wb6gu3Xr1q1b19c1/+p+yf9w/AX4ISOxS1Tl9AAAAABJRU5ErkJggg==')
                widgetHeader.appendChild(closeChatbox);
                    closeChatbox.setAttribute('id', 'close-chatbox');
                    // closeChatbox.setAttribute('onclick', "toggleChat('chat-box')");
                    closeChatbox.style="box-sizing: border-box;font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; cursor: pointer; position: absolute; top: 10px; left: 270px; width: 16px; height: 16px; float: left; transition: all 0.4s ease; margin: 0; padding: 3px; border: 0;";
                    closeChatbox.appendChild(closeChatbox1);
                        closeChatbox1.style="box-sizing: border-box;font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; width: 2px; height: 12px; position: absolute; top: 2px; right: 7px; transform: rotate(45deg); background-color: white; margin: 0; padding: 0; border: 0;";
                    closeChatbox.appendChild(closeChatbox2);
                        closeChatbox2.style="box-sizing: border-box;font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; width: 2px; height: 12px; position: absolute; top: 2px; right: 7px; transform: rotate(-45deg); background-color: white; margin: 0; padding: 0; border: 0;";
                widgetHeader.appendChild(separate);
                    separate.setAttribute('src', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAaUAAAAlCAMAAADVywbwAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAkUExURQAAAP///////////////////////////////////////////7QJjekAAAALdFJOUwC3it1078qiVTcdsdWDjgAAAxlJREFUaN7tmu1yhSAMRBGBAL7/+/aK+IGCEkCFjvuvM23HeNhkQQiljEmplCaf6lW3CiiTH63aKc2wPlYNULK+kup7ObVTMqLsI1U/JUPq81QDlEZ9lmqBkrHUFyjqp2RAtVCP1krJjX47wX+wvoQQ8aBqbn1aSUYhGFnb3l70o+JJAauwVi0ZxLUD1mjj7mdFk6KqLkK0QwlaHLH9VqIxQ6lID9Uchn6dWjJGKfy0f8+j6E8upXhQFRhKsS5H8PqQ1So8SF0RPqnnWFBQPPLN8YyNmvJZcOJnInofFKoNkMHVhCwSVLnGZwJaQMd0piV0pfQKKIWcpXtKG1wxrEo0Ph0GtEW1kMLGhdocpfFtIEhphXUe/jI5KUmjNXpKs+4GATpMaD3251njTzfZKIrSyqpgiSmIjACzBcemvrjObBOZ3/Ds6qwjsVXHUbKsgrZKGVAai4h2keFGCGF+ke9l94XBKtTF5GTRj/rj5Uk+yeMUQ2lGVaLxKYa20dV2YWTDeWwZ3LeP928Ez6LNNazFWio98qApTaQ87wmRzBNsJPbbuu0DjHiGNB3m7q5/61RA+5SqcjIPGVLlMVVc48PbqOt9EhMgzod8OetuHlGqBCErgTotLUfJS+p6BqMZHWy0qAgff0aisiChZaLasfg0JR+psxmsZc40uhHQRuOLNK8TbmCUyIqUWYUOqVA0x9oo0OluJOSEi0Kguj6oS1ZzICLlCnNbu860kRfRE4D2xy9wF6MNK+HFsz4JKVzYSmrrKGxS8jW6Zwk5wyoVFEQw2sES3rxKbqhrMRWY0zckIjjGhZcAOajwngLRY8RPqiR31TUnZdHF1wfdgdDrgHaNIn2pndC5rJHcvAb5vLUBuOIjopfWy6wuhlUcIc4RFZJnGobNTHZMgtX20A2ztOqgZc+YwK3mlAyOzcOUdh8ZvRraYIMtq0xtZPhUvz5KTVBimTJXlA73k8ZD+/VXIPZUdDqhdv8668F8d6emTwq5/x1MSMAMGTvIIKG8h682Kbl86lwum1F2/Y2zgZvpbFvXnGiny1DZtf0BAtDRZ0X7njwAAAAASUVORK5CYII=');
                    separate.style="width: 100%; box-sizing: border-box;font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; margin: 0; padding: 15px 0 0 !important; border: 0;";
            chatBox.appendChild(chatContent);
                chatContent.setAttribute('src', 'https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fserenitydentalclinic%2F&tabs=messages&width=300&height=300&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=false&appId=132827523849775');
                chatContent.setAttribute('width', '300');
                chatContent.setAttribute('height', '300');
                chatContent.setAttribute('scrolling', 'no');
                chatContent.setAttribute('frameborder', '0');
                chatContent.setAttribute('allowtransparency', 'true');
                chatContent.style="font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; overflow: hidden; margin: -69px 0 -7px; padding: 0; border: 0 none;";
            chatBox.appendChild(chatContentCenter);
                chatContentCenter.style="font-size: normal; border: 0; font-style: normal; font-variant: normal; padding: 0; line-height: normal; margin: 0; font-weight: normal; vertical-align: baseline;";
                chatContentCenter.appendChild(chatContentCenterLink);
                    chatContentCenterLink.setAttribute('href', 'https://messengerify.me');
                    chatContentCenterLink.setAttribute('target', '_blank');
                    chatContentCenterLink.style="font-size: 12px; line-height: 44px; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; color: #3ADF70; text-decoration: none; margin: 0; padding: 0; border: 0;";
                    chatContentCenterLink.appendChild(chatContentCenterLinkText);

        messengerify.appendChild(widgetButton);
            widgetButton.style="float: right; position: relative; font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; margin: 0; padding: 0; border: 0;";
            widgetButton.appendChild(welcomeMessages);
                welcomeMessages.setAttribute('id', 'welcome-messages');
                welcomeMessages.style="display: none; border: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; padding: 0px; line-height: normal; margin: 0px; font-weight: normal; vertical-align: baseline;";
                welcomeMessages.appendChild(closeMessage);
                    closeMessage.setAttribute('id', 'close-message');
                    closeMessage.style="display: none; opacity: 0; transition: all 0.4s ease; font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; cursor: pointer; position: absolute; top: -16px; right: 0px; width: 16px; height: 16px; float: left; transition: all 0.4s ease; margin: 0; padding: 3px; border: 0;";
                    closeMessage.appendChild(closeMessage1);
                        closeMessage1.style="font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; width: 2px; height: 12px; position: absolute; top: 2px; right: 7px; transform: rotate(45deg); background-color: #5f5f5f; margin: 0; padding: 0; border: 0;";
                    closeMessage.appendChild(closeMessage2);
                        closeMessage2.style="font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; width: 2px; height: 12px; position: absolute; top: 2px; right: 7px; transform: rotate(-45deg); background-color: #5f5f5f; margin: 0; padding: 0; border: 0;";
                welcomeMessages.appendChild(welcomeMessage1);
                    welcomeMessage1.setAttribute('id', 'welcome-message-1');
                    welcomeMessage1.style="clear: both; transform:scale(0); display:none; transition: all 0.3s ease; cursor: pointer; font-size: normal; line-height: 1.5; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; float: right; color: #3c3c3c; border-left-color: #3ADF70; border-left-style: solid; box-shadow: 2px 4px 14px 0px rgba(0, 0, 0, 0.10); background-color: white; margin: 10px 0px 0px; padding: 10px; border-width: 0 0 0 3px;";
                    welcomeMessage1.appendChild(welcomeMessage1Text);
                welcomeMessages.appendChild(welcomeMessage2);
                    welcomeMessage2.setAttribute('id', 'welcome-message-2');
                    welcomeMessage2.style="clear: both; transform:scale(0); display:none; transition: all 0.3s ease; cursor: pointer; font-size: normal; line-height: 1.5; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; float: right; color: #3c3c3c; border-left-color: #3ADF70; border-left-style: solid; box-shadow: 2px 4px 14px 0px rgba(0, 0, 0, 0.10); background-color: white; margin: 10px 0px 0px; padding: 10px; border-width: 0 0 0 3px;";
                    welcomeMessage2.appendChild(welcomeMessage2Text);
            widgetButton.appendChild(chatHead);
                chatHead.setAttribute('id', 'chat-head');
                // chatHead.setAttribute('onclick', "toggleChat('chat-box')");
                chatHead.style="transform: scale(1); line-height: normal; font-style: normal; font-weight: normal; font-variant-ligatures: normal; font-variant-caps: normal; vertical-align: baseline; cursor: pointer; width: 60px; height: 60px; float: right; border-radius: 50%; position: relative; box-shadow: rgba(0, 0, 0, 0.0980392) 2px 4px 14px 0px; transition: all 0.4s ease; margin: 10px 0px 0px; padding: 0px; border: 0px;";
                chatHead.appendChild(chatHeadStatus);
                    chatHeadStatus.style="font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; vertical-align: baseline; z-index: 10000; width: 12px; height: 12px; border-radius: 50%; position: absolute; right: 0px; bottom: 41px; background-image: linear-gradient(-180deg, #41ffab 1%, #00dbb1 100%); margin: 0; padding: 0; border: 2px solid white;";
                chatHead.appendChild(chatHeadAvatar);
                    chatHeadAvatar.setAttribute('src', avatarUrl);
                    chatHeadAvatar.style="width: 100%; background: white; border-radius: 50%; vertical-align: middle; font-size: normal; line-height: normal; font-style: normal; font-weight: normal; font-variant: normal; margin: 0; padding: 0; border: 0;";

    }

    function toggleChat(elementId) 
    {
        var element= document.getElementById(elementId);
        if(element.style.display== 'none') {
            element.style.display= 'block';
            element.style.opacity= '1';
        } else {
            element.style.display= 'none';
            element.style.opacity= '0';
        }
    }

// }


