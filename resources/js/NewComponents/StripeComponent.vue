<script>
    import { StripeCheckout } from '@vue-stripe/vue-stripe';

    export default {
        components: {
            StripeCheckout,
        },
        data() {
            return {
                publishableKey:'pk_test_51MnGmGK1P0dJ1e9fivkKGA0aICuK2W9pcWD4wIHjegcFss7HCJvHf4xG3irfue1cwN9v1ubyc84Kvj5RG8epx0hq00gMstB8TH',
                sessionId: null,
                loading: false,
            }
        },
        mounted() {
            console.log('componente momtado')
            this.getSession()
        },
        methods: {
            getSession() {
                axios.get('getSession')
                .then(res => {
                    //console.log(res);
                    this.sessionId = res.data.id
                }).catch(err => {
                     // handle the error her
                     console.log(err);
                })
            },
            submit () {
                // You will be redirected to Stripe's secure checkout page
                this.$refs.checkoutRef.redirectToCheckout();
            },
        },
    }
</script>

<template>
    <!-- empty template block -->
    <h1>Pago Unico</h1>
    <p>Ejemplo pago único Stripe Inertia Vuejs</p>
    <div class="container">
        <stripe-checkout
            ref="checkoutRef"
            :pk="publishableKey"
            :sessionId="sessionId"
        />

        <button @click="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Pago Unico</button>

    </div>
</template>

