function main($, AjaxUrl) {
    var ajax_url = AjaxUrl;
        $("#primaryButton").click( function()
        {
            OhmsLaw()
        })

    function OhmsLaw() {
        var details =
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

};