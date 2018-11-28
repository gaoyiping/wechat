<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>{$system->name}</title>
{literal}
<style>
body {
		margin: 0;
	}
	

	#button {
		font-family: "Gill Sans", "Gill Sans MT", Calibri, sans-serif;
		position: fixed;
		font-size: 1.5em;
		text-transform: uppercase;
		padding: 7px 20px;
		left: 50%;
		width: 200px;
		margin-left: -100px;
		top: 70%;
		border-radius: 10px;
		color: white;
		text-shadow: -1px -1px 1px rgba(0,0,0,0.8);
		border: 5px solid transparent;
		border-bottom-color: rgba(0,0,0,0.35);
		background: hsla(6, 89%, 38%, 1);
		cursor: pointer;

		animation: pulse 1s infinite alternate;
		transition: background 0.4s, border 0.2s, margin 0.2s;
	}
	#button:hover {
		background: hsla(220, 100%, 60%, 1);
		margin-top: -1px;

		animation: none;
	}
	#button:active {
		border-bottom-width: 0;
		margin-top: 5px;
	}
	@keyframes pulse {
		0% {
			margin-top: 0px;
		}
		100% {
			margin-top: 6px; 
		} 
	}
</style>
{/literal}
  <script src="style/js/prefixfree.min.js"></script>
</head>

<body>
<button onclick="window.location.href='index.php?module=shop'" id="button">立即购买</button>
<a href="index.php?module=shop"><img src="shop.jpg" style="width:100%" /></a>


</body>
</html>
