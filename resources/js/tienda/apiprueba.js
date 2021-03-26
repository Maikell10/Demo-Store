new Vue({
    el: "#apiprueba",
    data() {
        return {
            info: null
        }
    },
    mounted() {
        let url = "/api/product";
        axios.get(url).then(response => {
            this.info = response.data;
            console.log(this.info)
        });
    }
});

