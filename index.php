<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>MMR калькулятор</title>

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

</head>
<body style="visibility: hidden">
<div id="app">
    <v-app>
        <v-snackbar
            timeout="6000"
            top
            color="error"
            v-model="snackbar"
        >
            {{ snackbarText }}
            <v-btn dark flat @click.native="snackbar = false">OK</v-btn>
        </v-snackbar>

        <v-content class="grey lighten-3">
            <v-layout>
                <v-flex xs10 offset-xs1 sm8 offset-sm2 md6 offset-md3>

                    <v-spacer class="mb-4"></v-spacer>

                    <template>
                        <v-stepper v-model="step">

                            <v-stepper-header>

                                <v-stepper-step step="1" :complete="step > 1" :editable="step > 1">
                                    Укажите начальный и конечный MMR
                                </v-stepper-step>

                                <v-divider></v-divider>

                                <v-stepper-step step="2" :complete="step > 1">
                                    Узнайте стоимость
                                </v-stepper-step>

                            </v-stepper-header>

                            <v-stepper-items>

                                <v-stepper-content step="1">

                                        <v-form ref="form" v-model="valid" lazy-validation>

                                            <v-text-field
                                                v-model="startMMR"
                                                :rules="startMMRRules"
                                                type="number"
                                                label="Начальный MMR"
                                                required
                                            ></v-text-field>

                                            <v-text-field
                                                v-model="endMMR"
                                                :rules="endMMRRules"
                                                type="number"
                                                label="Желаемый MMR"
                                                required
                                            ></v-text-field>

                                            <v-btn
                                                color="primary"
                                                @click="calculate()"
                                                :disabled="!valid"
                                            >
                                                Далее
                                            </v-btn>

                                        </v-form>

                                </v-stepper-content>


                                <v-stepper-content step="2" class="text-xs-center">

                                    <v-progress-circular :size="50" v-if="price === null" indeterminate color="primary"></v-progress-circular>
                                    <h3 v-else class="headline mb-1">{{price}} RUB</h3>

                                </v-stepper-content>

                            </v-stepper-items>

                        </v-stepper>

                    </template>

                    <v-spacer class="mb-3"></v-spacer>

                </v-flex>
            </v-layout>
        </v-content>
    </v-app>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource"></script>
<script src="https://unpkg.com/vuetify/dist/vuetify.min.js"></script>

<script>

    var app = {
        el: '#app',
        data: {
            step: 1,
            startMMR: null,
            endMMR: null,
            price: null,
            valid: true,
            snackbar: false,
            snackbarText: '',

            cache: {
                startMMR: null,
                endMMR : null
            },

            startMMRRules: [
                v => !!v || 'Укажите начальный MMR',
                v => (v >= 0) || 'Количество MMR не должно быть меньше 0',
            ],

            endMMRRules: [
                v => !!v || 'Укажите желаемый MMR',
                v => (v >= 0) || 'Количество MMR не должно быть меньше 0',
                v => (v <= 7000) || 'Максимум 7000 MMR',
            ],
        },

        methods: {

            'calculate': function () {

                if (this.$refs.form.validate()){

                    if(app.data.cache.startMMR !== app.data.startMMR || app.data.cache.endMMR !== app.data.endMMR){

                        if(app.data.startMMR >= app.data.endMMR){
                            app.data.snackbar = true;
                            app.data.snackbarText = 'Желаемый MMR должен быть больше начального';
                            return;
                        }

                        app.data.cache.startMMR = app.data.startMMR;
                        app.data.cache.endMMR = app.data.endMMR;
                        app.data.price = null;

                        fetch('/ajaxCalculate.php?startMMR='+app.data.startMMR+'&endMMR='+app.data.endMMR)
                            .then((response) => {
                                if(response.ok) {
                                    return response.json();
                                }

                                throw new Error('Error response');
                            })
                            .then((json) => {
                                app.data.price = json.price;
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    }

                    app.data.step = 2;
                }

            }

        },

        created: function(){
            document.body.style.visibility = 'visible';
        },
    };

    new Vue(app);
</script>

</body>
</html>