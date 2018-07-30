<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SOAP and cUrl Client task</title>
	<link rel="stylesheet"
	      href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
	<link rel="stylesheet" href="templates/css/styles.css">
	<script src="https://ru.vuejs.org/js/vue.js"></script>
</head>

<body>


<section class="section">
	<div class="section level-item">
		<div id="app">
			<div class="columns">

				<form method="POST" enctype="multipart/form-data">
					<h1><span>SOAP</span> and <span>cUrl</span> Client task</h1>
					<table
							class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">

						<tbody>
						<tr class="control">
							<td style="text-align: right; vertical-align: middle;"> Enter a
								value in Celsius
							</td>
							<td><input class="input" id="celsius" type="number" value=""
							           placeholder="35°C" v-model.number="dataForm.celsius">
							</td>
						</tr>
						<tr class="control">
							<td style="text-align: right;vertical-align: middle;"> Enter the
								country abbreviation
							</td>
							<td><input class="input" id="country" type="text" value=""
							           placeholder="UA" v-model.trim="dataForm.country">
							</td>
						</tr>
						<tr class="control">
							<td style="text-align: right;"> Select the query method</td>
							<td><label class="SOAP">
									<input type="radio" name="type" id="SOAP" value="SOAP"
									       v-model="dataForm.mode">
									SOAP
								</label>&nbsp;
								<label class="radio">
									<input type="radio" name="type" id="cUrl" value="cUrl"
									       v-model="dataForm.mode">
									cUrl
								</label></td>
						</tr>
						<tr class="control">
							<td colspan="2" style="text-align: center;">
								<button @click.self.prevent="getFormValues()" type="submit"
								        v-bind:class="[dispatch ? dispatchLoad : success]"
								        class="button is-small"> Send Request
								</button>
							</td>
						</tr>
						</tbody>
					</table>
				</form>


			</div>

			<div v-cloak v-if="errorActiv" class="notification is-danger">
				<div v-if="error.country">{{ error.country }}</div>
				<div v-if="error.celsius">{{ error.celsius }}</div>
			</div>

			<h2 v-cloak v-bind:class="[!dataSend ? activeClass : '']" class="title">
				Answer is using <span>{{ dataSend }}</span></h2>
			<table v-cloak v-bind:class="[!dataSend ? activeClass : '']"
			       class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
				<caption>
					Temperature Converter
				</caption>
				<tbody>
				<tr class="control">
					<td style="text-align: right; vertical-align: middle;"> Value in
						Celsius {{ dataCels }} °C
					</td>
					<td>Value in Fahrenheit {{ dataResponse.celsius }} °F</td>
				</tr>
				</tbody>
			</table>

			<table v-cloak v-if="dataSend"
			       v-bind:class="[!dataSend ? activeClass : '']"
			       class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
				<caption>
					Country Info
				</caption>
				<tbody>
				<tr class="control">
					<td style="text-align: right; vertical-align: middle;"> Name</td>
					<td>{{ country.sName }}</td>
				</tr>
				<tr class="control">
					<td style="text-align: right; vertical-align: middle;"> Capital City
					</td>
					<td>{{ country.sCapitalCity }}</td>
				</tr>
				<tr class="control">
					<td style="text-align: right; vertical-align: middle;"> Languages</td>
					<td>{{ country.Languages.tLanguage.sName }}</td>
				</tr>
				<tr class="control">
					<td style="text-align: right; vertical-align: middle;">Continent
						Code
					</td>
					<td>{{ country.sContinentCode }}</td>
				</tr>
				<tr class="control">
					<td style="text-align: right; vertical-align: middle;">Currency ISO
						Code
					</td>
					<td>{{ country.sCurrencyISOCode }}</td>
				</tr>
				<tr class="control">
					<td style="text-align: right; vertical-align: middle;">Flag</td>
					<td><img v-bind:src="country.sCountryFlag"
					         v-bind:alt="country.sName"/></td>
				</tr>
				</tbody>
			</table>

		</div>
	</div>
</section>


<script src="templates/js/main.js"></script>


</body>
</html>