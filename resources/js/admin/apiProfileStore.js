const apiProfileStore = new Vue({
    el: "#apiProfileStore",
    data: {
        inputName: $('#inputNameH').val(),
        inputPassword: '',
        inputCheckbox: false,

        inputPhone: $('#inputPhoneH').val(),
        inputFacebook: $('#inputFacebookH').val(),
        inputTwitter: $('#inputTwitterH').val(),
        inputInstagram: $('#inputInstagramH').val(),
        inputGoogleMaps: $('#inputGoogleMapsH').val(),

        inputCountry: $('#inputCountryH').val(),
        inputState: $('#inputStateH').val(),

        cities: ''
    },
    methods: {
        setCheck() {
            if (this.inputCheckbox == true) {
                $('#btnConfig').prop('disabled', true);
            }
            if (this.inputCheckbox == false) {
                $('#btnConfig').prop('disabled', false);
            }
        },
        updateUser() {
            if (this.inputName.length > 0) {
                Swal.fire({
                    title: "Estas seguro de Editar tus Datos?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí!",
                    cancelButtonText: "No"
                }).then(result => {
                    if (result.value) {
                        document.getElementById("updateUserForm").submit();
                    } else {
                        Swal.fire(
                            "Cancelado!",
                            "Cancelado!",
                            "error"
                        );
                    }
                })
            }else {
                Swal.fire({
                    icon: 'error',
                    title: 'Fallo al Editar!',
                    showConfirmButton: false,
                    timer: 1200
                })
            }
        },
        updateStoreUser() {
            Swal.fire({
                title: "Estas seguro de Editar tus Datos de Tienda?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí!",
                cancelButtonText: "No"
            }).then(result => {
                if (result.value) {
                    document.getElementById("updateStoreForm").submit();
                } else {
                    Swal.fire(
                        "Cancelado!",
                        "Cancelado!",
                        "error"
                    );
                }
            })
        },
        saveStoreUser() {
            Swal.fire({
                title: "Estas seguro de Guardar tus Datos de Tienda?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí!",
                cancelButtonText: "No"
            }).then(result => {
                if (result.value) {
                    document.getElementById("updateStoreForm").submit();
                } else {
                    Swal.fire(
                        "Cancelado!",
                        "Cancelado!",
                        "error"
                    );
                }
            })
        },

        loadCities() {
            this.selected_inputCountry = $("#inputCountry").val();
            axios
                .get("http://tiendademo1.test/api/cities/" + this.selected_inputCountry)
                .then(response => {
                    this.cities = response.data;
                });
        },
    },
    mounted() {
        $("#btnConfig").on("click",function(e){
            e.preventDefault() 
        })

        if (this.inputCheckbox == false) {
            $('#btnConfig').prop('disabled', true);
        }

        $('#updateStoreForm').on("submit", function(e){
            e.preventDefault() 
        })

        $("#inputCountry").on('change', async function() {
            await apiProfileStore.loadCities()
        });

        $('#inputCountry').select2();
        $('#inputState').select2();

        if (this.inputCountry != '') {
            $("#inputState option[value='"+$("#inputStateH").val()+"']").attr("selected","selected");
            this.loadCities()
        }
    }
});