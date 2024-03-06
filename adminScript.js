$(document).ready(function(){
    fetchApmacibas()
    fetchApmacPiet()

    function fetchApmacibas(){
        $.ajax({
            url: 'saraksts.php',
            type: 'GET',
            success: function(response){
                const apmacibas = JSON.parse(response)
                let template = ''
                apmacibas.forEach(apmaciba =>{
                    template += `
                        <tr apmID ="${apmaciba.id}">
                            <td>${apmaciba.id}</td>
                            <td>${apmaciba.nosaukums}</td>
                            <td>${apmaciba.apraksts}</td>
                            <td><img src='${apmaciba.attels}' alt='Bilde'></td>
                            <td>${apmaciba.statuss}</td>
                            <td>${apmaciba.veidotajs}</td>
                            <td>EDIT</td>
                        </tr>
                    `
                })

                $('#apmacibas').html(template)
            }
        })
    }

    function fetchApmacPiet(){
        $.ajax({
            url: 'sarakstsPiet.php',
            type: 'GET',
            success: function(response){
                const apmacibas = JSON.parse(response)
                let template = ''
                apmacibas.forEach(apmaciba =>{
                    template += `
                        <tr apmID ="${apmaciba.id}">
                            <td>${apmaciba.id}</td>
                            <td>${apmaciba.nosaukums}</td>
                            <td>${apmaciba.apraksts}</td>
                            <td><img src='${apmaciba.attels}'></td>
                            <td>${apmaciba.statuss}</td>
                            <td>${apmaciba.veidotajs}</td>
                            <td>EDIT</td>
                        </tr>
                    `
                })

                $('#apmacibasPiet').html(template)
            }
        })
    }

    $(document).on('click', '#new', (e) => {
        $(".modal").css('display','flex')
    })

    $(document).on('click', '.close_modal', (e) => {
        $(".modal").hide()
        edit = false
        $("#apmacForma").trigger('reset')
    })
})