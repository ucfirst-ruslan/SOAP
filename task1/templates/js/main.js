<div id="app">
    <input type="radio" value="SOAP" v-model="method">
    <label>SOAP</label>
    <br>
    <input type="radio" value="cUrl" v-model="method">
    <label>cUrl</label>
    <br>
    <span>Выбрано: {{ method }}</span>
</div>

<script src="https://ru.vuejs.org/js/vue.js"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            method:'SOAP'
        }
    });
</script>





<!DOCTYPE html>
<html>
<head>
<title>Формы во Vue.js</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<style>
[v-cloak] {
  display: none;
}
</style>

</head>
<body>
<div id="app" class="col-md-4">

    <label>Enter number</label>
    <input v-model.number="celsius" type="number" placeholder="22">
	
    <label>Enter country (UA)</label>
    <input type="text" v-model.trim="country" placeholder="UA"><br>
	
	
    <div v-cloak>
        <h3>Введенная информация</h3>
        <p>celsius: {{celsius}}</p>
        <p>country: {{country}}</p>
        <p>Возраст: {{age}}</p>
        <p>Дата регистрации: {{date}}</p>
    </div>
</div>
<script src="https://ru.vuejs.org/js/vue.js"></script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            country:'',
            celsius: 22
        }
    });
</script>
</body>
</html>