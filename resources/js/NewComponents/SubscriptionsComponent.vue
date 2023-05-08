<script>
    import { StripeCheckout } from '@vue-stripe/vue-stripe';

    export default {
        components: {
            StripeCheckout,
        },
        data() {
            return {
                publishableKey:'pk_test_51MnGmGK1P0dJ1e9fivkKGA0aICuK2W9pcWD4wIHjegcFss7HCJvHf4xG3irfue1cwN9v1ubyc84Kvj5RG8epx0hq00gMstB8TH',
                sessionIdMensual: null,
                sessionIdAnual: null,
                sessionIdSemestral: null,
                loading: false,
            }
        },
        mounted() {
            //console.log('componente momtado')
            this.getSessionMensual()
            this.getSessionAnual()
            this.getSessionSemestral()
        },
        methods: {
            getSessionMensual() {
                axios.get('getSessionMensual')
                .then(res => {
                    //console.log(res);
                    this.sessionIdMensual = res.data.id
                }).catch(err => {
                     // handle the error her
                     console.log(err);
                })
            },
            getSessionAnual() {
                axios.get('getSessionAnual')
                .then(res => {
                    this.sessionIdAnual = res.data.id
                }).catch(err => {
                    console.log(err);
                })
            },
            getSessionSemestral() {
                axios.get('getSessionSemestral')
                .then(res => {
                    this.sessionIdSemestral = res.data.id
                }).catch(err => {
                    console.log(err);
                })
            },
            submitMensual () {
                this.$refs.checkoutRefMensual.redirectToCheckout();
            },
            submitAnual () {
                this.$refs.checkoutRefAnual.redirectToCheckout();
            },
            submitSemestral () {
                this.$refs.checkoutRefSemestral.redirectToCheckout();
            },
        },
    }
</script>


<template>
    <h1>Suscripcion</h1>
    <p>Ejemplo Suscripcion Stripe Inertia Vuejs</p>
    <div class="container">
        <stripe-checkout
      ref="checkoutRefMensual"
      :pk="publishableKey"
      :sessionId="sessionIdMensual"
      :success-url="successURL"
      :cancel-url="cancelURL"
      @loading="v => loading = v"
    />

    <button @click="submitMensual" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      Suscripción Mensual
    </button>

        <stripe-checkout
            ref="checkoutRefAnual"
            :pk="publishableKey"
            :sessionId="sessionIdAnual"
        />

        <button @click="submitAnual" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Suscripcion Anual</button>

        <stripe-checkout
            ref="checkoutRefSemestral"
            :pk="publishableKey"
            :sessionId="sessionIdSemestral"
        />

        <button @click="submitSemestral" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Suscripcion Semestral</button>


    </div>
</template>

