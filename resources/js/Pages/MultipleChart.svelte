<script>
import {onMount} from "svelte";
import { element } from "svelte/internal";
import Chart from 'chart.js/auto';



    let isDataSent = false; 
    const currUrl = window.location.search;

    isDataSent = currUrl.indexOf('?') > -1 ? true : false;

    let graphData = [];
    let canvas;
	let ctx;
    let myChart;
    let newValue = {
        key: '',
        value: ''
    }
    
    let maxWidth = 500;
    let editDetails = {
        info: false,
        data: false,
        notes: false
    }
   
    let graphColors = [
        {
            points: "rgb(0,255,200)",
            background: "rgb(0,255,200,0.1)"    
        },
        {
            points: "rgb(0,162,255)",
            background: "rgb(0,162,255,0.1)"
        },
        {
            points: "rgb(0, 68, 255)",
            background:"rgb(0, 68, 255,0.1)" 
        },
        {
            points: "rgb(0, 255, 42)",
            background: "rgb(0, 255, 42,0.1)"
        },
        {
            points: "rgb(200, 255, 0)",
            background: "rgb(200, 255, 0, 0.1)"
        },
        {
            points: "rgb(255, 145, 0)",
            background: "rgb(255, 145, 0, 0.1)"
        },
        {
            points: "rgb(255, 72, 0)",
            background: "rgb(255, 72, 0, 0.1)"
        },
        {
            points: "rgb(200, 255, 0)",
            background: "rgb(200, 255, 0, 0.1)"
        },
        {
            points: "rgb(105,68,11)",
            background: "rgb(105,68,11,0.1)"
        },
        {
            points: "rgb(255,187,0)",
            background: "rgb(255,187,0,0.1)"
        }
    ]

    let labels = [];
    let datasets = [];
    
    if(isDataSent) {
    
        const urlParams = new URLSearchParams(currUrl);
        let entries = urlParams.entries();
        console.log(entries)

        for(let [key, value] of entries) {
        
            graphData.push({key: key, value: value})
        }

        labels = [...graphData[0].value.split(";")]
        graphData.shift();
        console.log(graphData);
    
        datasets = graphData.map(function(record, index) {

            return {
                data: record.value.split(";"),
                label: record.key,
                borderColor: graphColors[index].points,
                backgroundColor: graphColors[index].background,
                borderWidth:2
            }
        }); 
    
        console.log(datasets);

    }
    

    function updateChartTitle(chart, label) {
        console.log(chart)
        chart.data.datasets[0].label = label;
        chart.update();
    }

    function updateChartValues(chart, data) {
        console.log(chart)
        console.log(data)
        chart.data.labels = data.map((record) => record.key)
        chart.data.datasets[0].data = data.map((record) => record.value)
        chart.update();
    }

    function addRecord(value, data, chart) {
        graphData = [...data, {key: value.key, value: value.value}]
        chart.data.labels.push(value.key)
        chart.data.datasets[0].data.push(value.value)
        newValue.key = ''
        newValue.value = ''
        chart.update();
    }

	function drawChart(datasets) {

	    canvas = document.getElementById("myChart")
        ctx = canvas.getContext('2d');		
        canvas.style.backgroundColor = "white" 
        //ctx.save();
        //ctx.fillStyle = 'blue';
        //ctx.fillRect(0, 0, canvas.width , canvas.height); 
       // ctx.restore()
        let myChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: datasets,
            },
          
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add
                scale: {
                    min: 0,
                    max: 8,
                    stepSize: 2,
                },
                plugins: {
                    legend: {
                        display: false, 
                    }
                },
                scales: {
                    r: {
                        grid: {
                            color: 'lightgray',
                            circular: true
                        },
                        angleLines: {
                            color:'lightgray'
                        },
                        
                    } 
                },
                
            }
        });
        return myChart;
	}


	onMount(() => {
        console.log("the component has mounted");
        if(isDataSent) {

		    myChart = drawChart(datasets);
        }

    // http://192.168.1.13:8001/?A1=6&A2=5&A3=1&A4=4&B1=4&B2=3&B3=6&B4=3&C1=2&C2=1&C3=7&C4=9&D1=0&D2=2&D3=6&D4=3&
    // http://localhost:5000/?A1=6&A2=5&A3=1&A4=4&B1=4&B2=3&B3=6&B4=3&C1=2&C2=1&C3=7&C4=8&D1=0&D2=2&D3=6&D4=3&

    }); 

    /* function printChart(chartObject) {
        let a = document.createElement('a');
        a.href = document.getElementById('myChart').toDataURL('image/png', 1.0);
        a.download = 'chart.jpg';
        a.click();
    } */

</script>

<main>
	<h3 class="mb-5 text-center">Your data results</h3>
    <h4 class="text-center">Region results</h4>
	
   <!--  <Link to="region">All regions</Link> -->
    <div class="container mb-5"> 
        <div class="row">
            <div id="myDiv" class="col-lg-7 border border-dark my-1 p-3">
                {#if !isDataSent}
	                <h2 class="mt-3 text-center">No data was sent.</h2>
                    <h4 class="mt-2 text-center">Follow the instructions on the "How to" block</h4>
                {/if}
                <canvas id="myChart" style="width:100%;width:{maxWidth + 'px'};height:{maxWidth + 'px'};"></canvas>
            </div>

            <div class="col-lg-4">
                <div class="border border-dark m-1 p-3">
                    <!-- <button id="download"
                        class="btn btn-primary mb-3 "
                        on:click="{printChart(myChart)}"
                        >
                        Print graph
                    </button> -->
                
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne"> 
                                <button class="accordion-button {editDetails.info ? '' : 'collapsed'}" on:click={() => editDetails.info = !editDetails.info} type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Chart info
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse {editDetails.info ? 'show': ''}" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <!-- <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Title</span>
                                        <input type="text" class="form-control" placeholder="Title" aria-label="label" aria-describedby="label" bind:value={chartInfo.label} on:input="{updateChartTitle(myChart, chartInfo.label)}">
                                    </div> -->
                                    <label for="max-width">Current size: {maxWidth}px</label>
                                    <p>
                                        <input type="range" name="max-width" id="max-width" min="350" max="800" step="50" bind:value={maxWidth}>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item height-500">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button {editDetails.data ? '' : 'collapsed'}" on:click={() => editDetails.data = !editDetails.data} type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Chart data
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse {editDetails.data ? 'show' : ''}" aria-labelledby="panelsStayOpen-headingTwo"> 
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        Series:
                                        {#each graphData as record}
                                            <li class="list-group-item">{record.key}</li> 
                                        {/each}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne"> 
                                <button class="accordion-button {editDetails.notes ? '' : 'collapsed'}" 
                                    on:click={() => editDetails.notes = !editDetails.notes} 
                                    type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    How to
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse {editDetails.notes ? 'show': ''}" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    Format of the request should be: 
                                    <p>
                                        <ul>
                                            <li>
                                                Axis labels first, separated by semi-colon: A1;A2;B1;B2 
                                            </li>
                                            <li>
                                                Diferent datasets separated by &: region1&region2&region3
                                            </li>
                                            <li>
                                                Each region values should be separated by semi-colon. 
                                                <em class="fw-bold text-decoration-underline">!Important:</em> 
                                                make sure there is no trailing semi-colon after the last value of each region)
                                            </li>
                                        </ul>
                                    <p>
                                    Example: url/?labels=A1;A2;B1;B2&region1=2;3;1;6&region2=4;6;1;7
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                                
            </div>
        
        </div>
        
    </div>
	
</main>

<style>
	main {
		
		padding: 1em;
		margin: 0 auto;
	}

	h3 {
		color: rgb(0, 255, 200);
		color: rgb(21, 255, 0);
		color: rgb(0, 162, 255);
		color: rgb(0, 68, 255);
		color: rgb(0, 255, 42);
		color: rgb(200, 255, 0);
		color: rgb(255, 145, 0);
		color: rgb(255, 72, 0);
		color: rgb(105, 68, 11);
		color: rgb(98, 0, 255);
		color: rgb(255, 187, 0);
		text-transform: uppercase;
		font-size: 3em;
		font-weight: 100;
	}

    #myDiv {
        display: grid;
    }

    #myChart {
        justify-self: center;
    }

    .height-500 {
        max-height: 400px;
        overflow-y: auto;
    }
  
	
</style>