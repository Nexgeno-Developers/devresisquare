<div class="flex justify_between align_center w-100">
    <div class="sub_title">EPC</div>
    <x-backend.forms.button
        class=""
        name="Add EPC"
        type="secondary"
        size="sm"
        isOutline="{{false}}"
        isLinkBtn={{true}}
        link="https://#"
        onClick="copyHtml()"
    />
</div>

{{-- Complience page  --}}
<div class="dynamic_div">
    <div class="desktop_only">
        <table class="table rs_table ">
            <thead>
                <tr>
                    <th class="">Rating</th>
                    <th class="">Expiry Date</th>
                    <th class="">Image</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="">B</td>
                    <td class="">22/11/25</td>
                    <td class="img_thumb">
                        <img src="{{ asset('asset/images/temp-property.webp') }}" alt="image">
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
    <div class="mobile_only">
        <div class="rs_mobile_table">
            <div class="data-row">
                <div class="tr_row">
                    <div class="">Rating</div>
                    <div class="">B</div>
                </div>
                <div class="tr_row">
                    <div class="">Expiry Date</div>
                    <div class="">22/11/25</div>
                </div>
                <div class="tr_row">
                    <div class="">Image</div>
                    <div class="img_thumb"><img src="{{ asset('asset/images/temp-property.webp') }}" alt="image"></div>
                </div>
            </div>
        </div>
    </div>
</div>
