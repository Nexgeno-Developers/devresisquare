<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/main-style.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/backend/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Help Document</title>

    <style>
        html, body, .row{
            height: 100%;
        }

        blockquote,
        xmp{
            margin: 0;
            padding: 0;
            white-space: pre-line;
        }
        .gap-16{
            gap: 16px;
        }
        /* blockquote{
            background: #ecf3fa;
            padding: 16px;
        } */
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

        table,
        .rs_input,
        .pv_content_wrapper{
            background: #fff;
        }
       

        @media (max-width: 766px) {
            .h_section{
                width: 100% !important;
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
                    <li><a href="#tables"> Tables</a></li>
                    <li><a href="#dropdown"> Dropdown</a></li>
                    <li><a href="#inputs"> Inputs</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="h_section_wrapper" id="buttons">
                <h2>Buttons</h2>
                <blockquote>
                    <p>"Type" should be "secondary" or "primary".
                    "isOutline" to make button ouline make it "True" or "False"
                    If "isLinkBtn" is true button will be  < a > tag, its required link prop and if its false button will be < button >
                    "Size" should be "sm" or "lg".</p>
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
                <div class="row gap-16 ml_0">
                    <div class="h_section">
                        <div class="">
                            <h6>Property horizontal card</h6>
                            <div class="pv_card_wrapper">
                                <x-backend.property-card
                                    class=""
                                    propertyName="169-173 Portland Rd, Hove, East Sussex, BN3 5QJ"
                                    bed="2"
                                    bath="2"
                                    floor="6"
                                    living="1"
                                    type="Appartment"
                                    available="02/05/2025"
                                    price="6542"
                                    cardStyle=""
                                    propertyId="1"
                                />
                            </div>
                            <blockquote>
                            &lt;x-backend.property-card
                                class=""
                                propertyName="&#x2774;&#x2774; &#36;property['prop_name'] &#x2775;&#x2775;"
                                bed="&#x2774;&#x2774; &#36;pproperty['bedroom'] &#x2775;&#x2775;"
                                bath="&#x2774;&#x2774; &#36;pproperty['bathroom'] &#x2775;&#x2775;"
                                floor="&#x2774;&#x2774; &#36;pproperty['floor'] &#x2775;&#x2775;"
                                living="&#x2774;&#x2774; &#36;pproperty['reception'] &#x2775;&#x2775;"
                                type="&#x2774;&#x2774; &#36;pproperty['property_type'] &#x2775;&#x2775;"
                                available="&#x2774;&#x2774; &#36;pproperty['available_from'] &#x2775;&#x2775;"
                                price="&#x2774;&#x2774; &#36;pproperty['price'] &#x2775;&#x2775;"
                                cardStyle="" //for horizontal keep blank //
                                propertyId="&#x2774;&#x2774; &#36;property['id'] &#x2775;&#x2775;"
                                /&gt;
                           </blockquote>
                        </div>
                    </div>
                    <div class="h_section">
                        <div class="">
                            <h6>Property Vertical card</h6>
                            <div class="pv_card_wrapper">
                                <x-backend.property-card
                                    class=""
                                    propertyName="169-173 Portland Rd, Hove, East Sussex, BN3 5QJ"
                                    bed="2"
                                    bath="2"
                                    floor="6"
                                    living="1"
                                    type="Appartment"
                                    available="02/05/2025"
                                    price="6542"
                                    cardStyle="vertical"
                                    propertyId="1"
                                />
                            </div>
                            <blockquote>
                            &lt;x-backend.property-card
                                class=""
                                propertyName="&#x2774;&#x2774; &#36;property['prop_name'] &#x2775;&#x2775;"
                                bed="&#x2774;&#x2774; &#36;pproperty['bedroom'] &#x2775;&#x2775;"
                                bath="&#x2774;&#x2774; &#36;pproperty['bathroom'] &#x2775;&#x2775;"
                                floor="&#x2774;&#x2774; &#36;pproperty['floor'] &#x2775;&#x2775;"
                                living="&#x2774;&#x2774; &#36;pproperty['reception'] &#x2775;&#x2775;"
                                type="&#x2774;&#x2774; &#36;pproperty['property_type'] &#x2775;&#x2775;"
                                available="&#x2774;&#x2774; &#36;pproperty['available_from'] &#x2775;&#x2775;"
                                price="&#x2774;&#x2774; &#36;pproperty['price'] &#x2775;&#x2775;"
                                cardStyle="vertical" //for Vertical chnage only this //
                                propertyId="&#x2774;&#x2774; &#36;property['id'] &#x2775;&#x2775;"
                                /&gt;
                           </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h_section_wrapper" id="tables">
                <h2>Tables</h2>
                <div class="row gap-16 ml_0">
                    <div class="h_section">
                        <div class="">
                            <h6>Responsive Table Without Action Button</h6>
                            {{-- table  compoent start--}}
                            @php
                            $headers = ['id','Status', 'Sub Status', 'Price', 'Frequency', 'Estate Agent', 'Move in', 'Move out'];
                            $rows = [
                                ['id' => 1,'Status' => 'Active', 'Sub Status' => 'Ready', 'Price' => '300', 'Frequency' => 'Quarterly', 'Estate Agent' => 'Tenant','Move in'=>'22/11/24', 'Move out'=>'21/02/25'],
                                ['id' => 1,'Status' => 'Inactive', 'Sub Status' => 'Not Ready', 'Price' => '2500', 'Frequency' => 'Yearly', 'Estate Agent' => 'Tenant','Move in'=>'22/11/25', 'Move out'=>'21/02/26'],
                            ];
                            @endphp
                            
                            <x-backend.dynamic-table-new  :headers="$headers" :rows="$rows" dropdownOptions="" actionBtn={{False}} class="" />
                            
                            <blockquote>
                                &lt;x-backend.dynamic-table-new  
                                headers="$headers" 
                                rows="$rows" 
                                dropdownOptions="" 
                                actionBtn=&#x2774;&#x2774; &#36;False&#x2775;&#x2775;
                                class="" 
                                /&gt;
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h_section_wrapper" id="dropdown">
                <h2>Dropdown</h2>
                <blockquote>
                    Default Dropdown use "isIcon" false</br>Icon Dropdown use "isIcon" true </br>
                </blockquote>
                <div class="row gap-16 ml_0">
                    <div class="h_section">
                        <div class="">
                            <h6>Dropdown</h6>
                            @php
                            $countries = [ 'us' => 'United States', 'ca' => 'Canada', 'uk' => 'United Kingdom', ];
                            $selectedCountry = 'ca';
                            @endphp
                            <x-backend.dropdown :options="$countries" :selected="$selectedCountry" isIcon={{false}} class=""/>
                            <blockquote>
                                &lt;x-backend.dropdown
                                    :options="&#36;countries"
                                    :selected="&#36;selectedCountry"
                                    isIcon=&#x2774;&#x2774;false &#x2775;&#x2775;
                                    class=""
                                /&gt;
                            </blockquote>
                        </div>
                    </div>
                    <div class="h_section">
                        <div class="">
                            <h6>Dropdown Icon Button</h6>
                            @php
                            $countries = [ 'edit' => 'Edit', 'delete' => 'Delete' ];
                            $selectedCountry = 'edit';
                            @endphp
                            <x-backend.dropdown :options="$countries" :selected="$selectedCountry" isIcon={{true}} class=""/>
                            <blockquote>
                                &lt;x-backend.dropdown
                                    :options="&#36;countries"
                                    :selected="&#36;selectedCountry"
                                    isIcon=&#x2774;&#x2774;true &#x2775;&#x2775;
                                    class=""
                                /&gt;
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h_section_wrapper" id="inputs">
                <h2>Inputs</h2>
                <blockquote>
                    Default Dropdown use "isIcon" false</br>Icon Dropdown use "isIcon" true </br>
                </blockquote>
                <div class="row gap-16 ml_0">
                    <div class="h_section">
                        <div class="">
                            <h6>Text Input With Label</h6>
                            <x-backend.input-comp
                                class=""
                                inputOpt=""
                                inputType="text"
                                rightIcon=""
                                inputName="full_name"
                                placeHolder="Full Name"
                                isLabel={{True}}
                                label="Name"
                                isDate={{False}}
                            />
                            <blockquote>
                                &lt;x-backend.input-comp
                                    class=""
                                    inputOpt=""
                                    inputType="text"
                                    rightIcon=""
                                    inputName="full_name"
                                    placeHolder="Full Name"
                                    isLabel=&#x2774;&#x2774;True&#x2775;&#x2775;
                                    label="Name"
                                    isDate=&#x2774;&#x2774;False&#x2775;&#x2775;
                                /&gt;
                            </blockquote>
                        </div>
                    </div>
                    {{-- h_section end  --}}

                    <div class="h_section">
                        <div class="">
                            <h6>Price without Label</h6>

                            <x-backend.input-comp
                                class=""
                                inputOpt="input_price"
                                inputType="number"
                                rightIcon="Per Month"
                                inputName="price"
                                isLabel={{False}}
                                label="Price"
                                isDate={{False}}
                            />
                            <blockquote>
                                &lt;x-backend.input-comp
                                    class=""
                                    inputOpt="input_price"
                                    inputType="number"
                                    rightIcon="Per Month"
                                    inputName="price"
                                    isLabel=&#x2774;&#x2774;False&#x2775;&#x2775;
                                    label="Price"
                                    isDate=&#x2774;&#x2774;False&#x2775;&#x2775;
                                /&gt;
                            </blockquote>
                        </div>
                    </div>
                    {{-- h_section end  --}}

                    <div class="h_section">
                        <div class="">
                            <h6>Date Input</h6>
                            <x-backend.input-comp
                                class=""
                                inputOpt=""
                                inputType="date"
                                rightIcon=""
                                inputName="from_date"
                                isLabel={{False}}
                                label=""
                                isDate={{True}}
                            />
                            <blockquote>
                                &lt;x-backend.input-comp
                                    class=""
                                    inputOpt=""
                                    inputType="date"
                                    rightIcon=""
                                    inputName="from_date"
                                    isLabel=&#x2774;&#x2774;False&#x2775;&#x2775;
                                    label=""
                                    isDate=&#x2774;&#x2774;True&#x2775;&#x2775;
                                /&gt;
                            </blockquote>
                        </div>
                    </div>
                    {{-- h_section end  --}}
                    <div class="h_section">
                        <div class="">
                            <h6>Custom Icon Input</h6>
                            <x-backend.input-comp
                                class=""
                                inputOpt="input_custom_icon"
                                inputType="text"
                                rightIcon=""
                                inputName="custom"
                                placeHolder="Custom Icon"
                                isLabel={{False}}
                                label=""
                                isDate={{false}}
                                isIcon={{true}}
                                iconName="bi-gear-fill"
                                onIconClick="onClick"
                            />
                            <blockquote>
                                &lt;x-backend.input-comp
                                    class=""
                                    inputOpt="input_custom_icon"
                                    inputType="text"
                                    rightIcon=""
                                    inputName="custom"
                                    placeHolder="Custom Icon"
                                    isLabel=&#x2774;&#x2774;False&#x2775;&#x2775;
                                    label=""
                                    isDate=&#x2774;&#x2774;False&#x2775;&#x2775;
                                    isIcon=&#x2774;&#x2774;True&#x2775;&#x2775;
                                    iconName="bi-gear-fill"
                                    onIconClick="onClick"
                                /&gt;
                            </blockquote>
                        </div>
                    </div>
                    {{-- h_section end  --}}

                </div>
            </div>
        </div>
    </div>

</body>
</html>
