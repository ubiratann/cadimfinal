<!DOCTYPE HTML>
<html>
<head>
<script>


window.onload = function () {

   
//Better to construct options first and then pass it as a parameter
var options = {
	title: {
		text: "Spline Chart with Export as Image"
	},
	animationEnabled: true,
    exportEnabled: true,
    data: [{
        type: "spline",
        datapoints:[
            for(va)

        ]
        <?php 
            echo file_get_contents("../sinais/ecg1.txt");
        ?>
        }
    ];
    /*
	data: [
	{
		type: "spline", //change it to line, area, column, pie, etc
		dataPoints: [
			{ x: 10, y: 10 },
			{ x: 20, y: 12 },
			{ x: 30, y: 8 },
			{ x: 40, y: 14 },
			{ x: 50, y: 6 },
			{ x: 60, y: 24 },
			{ x: 70, y: -4 },
			{ x: 80, y: 10 }
		]
	}
	] */
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
</head>
<body>
<?php 
        $arquivo = file('..sinais/ecg1.txt')    
    
    echo $arquivo[0];
    ?> <div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
</body>
</html>