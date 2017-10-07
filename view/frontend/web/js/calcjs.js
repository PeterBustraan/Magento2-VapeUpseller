function main($, AjaxUrl) {
    let ajax_url = AjaxUrl;
        $("#primaryButton").click( function()
        {
            OhmsLaw()
        });

        $(".calcReset").click(function () {
            clearField("#" + $(this).data("field"))
        })

    function OhmsLaw() {
        let details =
            {
                'volts' : $("#volts").val(),
                'amps'  : $("#amps").val(),
                'ohms'  : $("#ohms").val(),
                'watts' : $("#watts").val()
            };
        $.ajax({
            url:ajax_url,
            type: 'POST',
            data: details,
            dataType: 'json'
        }).done(function (data){
            $("#volts").val(data.volts)
            $("#amps").val(data.amps)
            $("#ohms").val(data.ohms)
            $("#watts").val(data.watts)
        })
    }

    function clearField(field) {
        $(field).val('0.0');
    }

};