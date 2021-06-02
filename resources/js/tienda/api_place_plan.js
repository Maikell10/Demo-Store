const api_place_plan = new Vue({
    el: "#api_place_plan",
    data: {
        lang: $("#lang").val(),
        auth_user: $("#auth_user").val(),
    },
    methods: {
        place_order(plan) {
            if (this.lang == 'es') {
                Swal.fire({
                    title: "¿Está seguro de adquirir este plan?",
                    text: "¡Puedes cambiar el plan de suscripción más tarde!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí!",
                    cancelButtonText: "Cancelar"
                }).then(result => {
                    if (result.value) {
<<<<<<< HEAD
                        location.replace('http://tiendademo1.test/plan_subscription/subscribe?gpont_=gheyudjiqnnsdk15_?daj_DfsR&plan='+plan+'&auth_user='+this.auth_user);
=======
                        location.replace('https://tuminimercado.com/plan_subscription/subscribe?gpont_=gheyudjiqnnsdk15_?daj_DfsR&plan='+plan+'&auth_user='+this.auth_user);
>>>>>>> fa3eebe9acece14827051d0507f00532207eafe3
                    } else {
                        Swal.fire(
                            "Cancelado!",
                            "Cancelado!",
                            "error"
                        );
                    }
                });
            } else {
                Swal.fire({
                    title: "Are You sure to purchase this Plan?",
                    text: "You can change the subscription plan later!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes!",
                    cancelButtonText: "Cancel"
                }).then(result => {
                    if (result.value) {
<<<<<<< HEAD
                        location.replace('http://tiendademo1.test/plan_subscription/subscribe?gpont_=gheyudjiqnnsdk15_?daj_DfsR&plan='+plan+'&auth_user='+this.auth_user);
=======
                        location.replace('https://tuminimercado.com/plan_subscription/subscribe?gpont_=gheyudjiqnnsdk15_?daj_DfsR&plan='+plan+'&auth_user='+this.auth_user);
>>>>>>> fa3eebe9acece14827051d0507f00532207eafe3
                    } else {
                        Swal.fire(
                            "Canceled!",
                            "Canceled!",
                            "error"
                        );
                    }
                });
            }
        },
    },
    mounted() {
        
    }
});