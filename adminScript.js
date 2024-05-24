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
                            <td>${apmaciba.cena}</td>
                            <td><a href="#"><button class="btn">Rediģēt</button></a></td>
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
                            <td>${apmaciba.cena}</td>
                            <td><a href="#"><button class="btn">Skatīt</button></a></td>
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
                        <tr pietID ="${pieteik.id}">
                            <td>${pieteik.id}</td>
                            <td>${pieteik.lietotajvards}</td>
                            <td>${pieteik.vards}</td>
                            <td>${pieteik.uzvards}</td>
                            <td>${pieteik.loma}</td>
                            <td><a href="#"><button class="liet-acpt btn">Apstiprināt</button></a></td>
                            <td><a href="#"><button class="liet-nor btn">Noraidīt</button></a></td>
                        </tr>
                    `
                })

                $('#lietotajPieteikumi').html(template)
            }
        })
    }

    $(document).on('click', '.liet-acpt', (e) => {
            const element = $(this)[0].activeElement.parentElement.parentElement.parentElement
            const id = $(element).attr('pietID')
            $.post('apstiprinaVeid.php', {id}, (response) =>{
                fetchLietPiet()
            })
    })

    $(document).on('click', '.liet-nor', (e) => {
        if(confirm('Vai tiešām vēlies noraidīt šo pieteikumu?')){
            const element = $(this)[0].activeElement.parentElement.parentElement.parentElement
            const id = $(element).attr('pietID')
            $.post('noraidVeid.php', {id}, (response) =>{
                fetchLietPiet()
            })
        }
    })
})