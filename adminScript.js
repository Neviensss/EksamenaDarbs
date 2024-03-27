$(document).ready(function(){
    fetchApmacibas()
    fetchApmacPiet()
    fetchLietPiet()

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

    function fetchLietPiet(){
        $.ajax({
            url: 'sarakstsLiet.php',
            type: 'GET',
            success: function(response){
                const pieteikums = JSON.parse(response)
                let template = ''
                pieteikums.forEach(pieteik =>{
                    template += `
                        <tr apmID ="${pieteik.id}">
                            <td>${pieteik.id}</td>
                            <td>${pieteik.lietotajvards}</td>
                            <td>${pieteik.vards}</td>
                            <td>${pieteik.uzvards}</td>
                            <td>${pieteik.loma}</td>
                            <td><a><button class="btn">Apstiprināt</button></a></td>
                            <td><a><button class="btn">Noraidīt</button></a></td>
                        </tr>
                    `
                })

                $('#lietotajPieteikumi').html(template)
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