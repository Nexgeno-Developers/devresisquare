<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/main-style.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/backend/css/style.css') }}" rel="stylesheet">
    <title>Help Document</title>

    <style>
        html, body, .row{
            height: 100%;
        }
        xmp{
            margin: 0;
            padding: 0;
            white-space: pre-line;
        }
        .gap-16{
            gap: 16px;
        }
        blockquote{
            background: #ecf3fa;
            padding: 16px;
        }
        .ml_0{
            margin-left: 0;
        }
        .h_sidebar{
            height: 100%;
            background: #f3f3f3;
            padding: 24px 24px 24px 32px;
            ul{
                list-style: number;
                padding-left:20px;
                padding: unset;

                li{
                    
                    a{
                        text-decoration: none;
                        color:#000;
                    }
                }
            }
        }
        .h_section_wrapper{
            margin: 60px 0;
            .h_section{
                background: #f3f3f3;
                padding:16px;
                border-radius:6px;
                width:fit-content;
            }
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-lg-2">
            <div class="h_sidebar">

                <ul>
                    <li><a href="#buttons"> Buttons</a></li>
                    <li><a href="#cards"> Cards</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="h_section_wrapper" id="buttons">
                <h2>Buttons</h2>
                <blockquote>
                    <p>"Type" should be "secondary" or "primary".</p>
                    <p>"isOutline" to make button ouline make it "True" or "False"</p>
                    <p>If "isLinkBtn" is true button will be  < a > tag, its required link prop and if its false button will be < button > </p>
                    <p>"Size" should be "sm" or "lg".</p>
                </blockquote>
                <div class="row gap-16 ml_0">
                    <div class="h_section">
                        <div class="" >
                            <h6>Primary Link Button</h6>
                            <x-backend.main-button
                                class=""
                                name="Primary"
                                type="primary"
                                size="sm"
                                isOutline="{{false}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onClick="copyHtml()"
                            />
                            <xmp id="primary_btn">
                            < x-backend.main-button
                                class=""
                                name="Primary"
                                type="primary"
                                size="sm"
                                isOutline="{{false}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onclick=""
                            / >
                            </xmp>
                        </div>
                    </div>
                    <div class="h_section">
                        <div class="">
                            <h6>Secondary Link Button</h6>
                            <x-backend.main-button
                                class=""
                                name="Secondary"
                                type="secondary"
                                size="sm"
                                isOutline="{{false}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onclick=""
                            />
                            <xmp>
                            < x-backend.main-button
                                class=""
                                name="Secondary"
                                type="secondary"
                                size="sm"
                                isOutline="{{false}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onclick=""
                            / >
                            </xmp>
                        </div>
                    </div>
                    <div class="h_section">
                        <div class="">
                            <h6>Secondary Outline Link Button</h6>
                            <x-backend.main-button
                                class=""
                                name="Outline Secondary"
                                type="secondary"
                                size="sm"
                                isOutline="{{true}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onclick=""
                            />
                            <xmp>
                            < x-backend.main-button
                                class=""
                                name="Outline Secondary"
                                type="secondary"
                                size="sm"
                                isOutline="{{true}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onclick=""
                            / >
                            </xmp>
                        </div>
                    </div>
                    <div class="h_section">
                        <div class="">
                            <h6>Pecondary Outline Link Button</h6>
                            <x-backend.main-button
                                class=""
                                name="Outline Primary"
                                type="primary"
                                size="sm"
                                isOutline="{{true}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onclick=""
                            />
                            <xmp>
                            < x-backend.main-button
                                class=""
                                name="Outline primary"
                                type="primary"
                                size="sm"
                                isOutline="{{true}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onclick=""
                            / >
                            </xmp>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h_section_wrapper" id="cards">
                <h2>Cards</h2>
                <blockquote>
                    <p>"Type" should be "secondary" or "primary".</p>
                    <p>"isOutline" to make button ouline make it "True" or "False"</p>
                    <p>If "isLinkBtn" is true button will be  < a > tag, its required link prop and if its false button will be < button > </p>
                    <p>"Size" should be "sm" or "lg".</p>
                </blockquote>
                <div class="row gap-16 ml_0">
                    <div class="h_section">
                        <div class="">
                            <h6>Primary Link Button</h6>
                            <x-backend.main-button
                                class=""
                                name="Primary"
                                type="primary"
                                size="sm"
                                isOutline="{{false}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onclick=""
                            />
                            <xmp>
                            < x-backend.main-button
                                class=""
                                name="Secondary"
                                type="secondary"
                                size="sm"
                                isOutline="{{false}}"
                                isLinkBtn={{false}}
                                link="https://#"
                                onclick=""
                            / >
                            </xmp>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyHtml() { 
            // Create a temporary element 
            const tempElement = document.createElement('div');
            tempElement.innerHTML = document.getElementById('primary_btn').innerHTML;

            // Append the temporary element to the body
            document.body.appendChild(tempElement);

            // Select the content
            if (document.createRange && window.getSelection) {
                const range = document.createRange();
                range.selectNodeContents(tempElement);
                const selection = window.getSelection();
                selection.removeAllRanges();
                selection.addRange(range);

                // Execute the copy command 
                try {
                    document.execCommand('copy');
                    alert('HTML content copied!');
                } catch (err) {
                    alert('Unable to copy HTML content.');
                }

                // Cleanup
                selection.removeAllRanges();
            }
            // Remove the temporary element
            document.body.removeChild(tempElement);

        } 
        </script>
        </script>
</body>
</html>