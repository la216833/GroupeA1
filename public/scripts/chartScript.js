const barCanvas = document.getElementById("barCanvas");

const barChart = new Chart(barCanvas,{
        type: "bar",
        data:{
            labels:["Coca", "Fanta", "RedBull"],
            datasets:[{
                label: "Le nombre d'articles vendus pour la periode du 22/01/2022 au 22/01/2023",
                data: [12,46,7],
                backgroundColor:[
                    "green"
                ]
            }]
        }
    }
)