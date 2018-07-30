new Vue({
    el: '#app',
    data: {
        dataForm: {"celsius": '', "country": '', "mode": ''},
        dataResponse: {},
        dataSend: '',
        dataCels: {},
        activeClass: 'active',
        dispatch: false,
        dispatchLoad: 'is-loading',
        success: 'is-success',
        error: {},
        errorActiv: false
    },
    computed: {
        country: function () {
            return this.dataResponse.country;
        }
    },
    methods: {
        getFormValues() {
            //console.log(JSON.stringify(this.dataForm));
            this.dispatch = true;
            this.errorActiv = false;
            this.error = {};
            if (this.dataForm.mode == false) {
                this.dataForm.mode = "SOAP";
            }
            this.fetchData();
        },

        fetchData: function () {
            let self = this;

            const myRequest = new Request('http://php.loc/SOAP/task1/');
            let data = new FormData();
            data.append("json", JSON.stringify(this.dataForm));

            fetch(myRequest, {
                method: 'POST',

                body: data //JSON.stringify(this.dataForm) // Отправка данных
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) { //Полученные данные
                    self.dataResponse = data;

                    if (self.dataResponse.error) {
                        self.error = self.dataResponse.error;
                        self.errorActiv = true;

                        console.log(self.dataResponse.error.country);
                        console.log(self.dataResponse.error.celsius);
                        self.dataResponse = {};
                    }
                    else if (self.dataResponse.country.sISOCode === '') {
                        self.error.country = self.dataResponse.country.sName;
                        self.errorActiv = true;
                        console.log(self.dataResponse.country.sName);
                        self.dataResponse = {};
                    }
                    else {
                        self.dataSend = self.dataForm.mode;
                        self.dataCels = self.dataForm.celsius;
                    }
                    self.dataForm = {"celsius": '', "country": '', "mode": ''};
                    self.dispatch = false;

                })
                .catch(function (error) { // Ошибка запроса
                    console.log('Request failed', error);
                });

        }
    }
})