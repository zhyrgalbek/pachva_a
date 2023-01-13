<style>
/* .error {
    border: 1px solid red;
}

.btn-primary {
    background-color: #366DC7;
    border: #366DC7;
} */
</style>
<template>
    <div class="content">
        <form action="#" class="form" id="form_ink" v-on:submit="submit">
            <div class="form__block">
                <label for="#" class="input__label">Введите ИНК</label>
                <div class="input-group">
                    <input type="text" v-bind:class="inputClass" id="ink" required placeholder=""
                        v-on:keyup="inputChange" aria-label="Recipient's username" aria-describedby="basic-addon2"
                        v-model="ink">
                    <div class="invalid-feedback" id="error">
                        {{ error }}
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary form_submit btn-lg">Проверить</button>
        </form>
    </div>
</template>

<script>
// const client = new ApolloClient({
//   link: new HttpLink({
//     uri: "http://192.46.233.197:8087/v1/graphql",
//     headers: {
//       "x-hasura-admin-secret":
//         "RS0wqjDPes994GzytgYqoxeYkspM66f47FenuK6HSjpCdSGAGLxxEKmM8tB3vEra",
//     },
//   }),
//   cache: new InMemoryCache(),
// });
export default {
    data() {
        return {
            ink: '',
            error: '',
            inputClass: {
                'form-control': true,
                error: false
            }
        }
    },
    methods: {
        inputChange() {
            if (this.ink.length > 0) {
                this.error = ''
                this.inputClass.error = false
            }
        },
        submit(e) {
            e.preventDefault()
            if (this.ink.length < 21) {
                this.inputClass.error = true
                this.error = 'Код ИНК должен иметь не меньше 21 цифры'
                return
            }
            alert(this.ink)
            // fetch('http://192.46.233.197:8087/v1/graphql', {
            //     method: 'POST',
            //     headers: {
            //         "x-hasura-admin-secret":
            //             "RS0wqjDPes994GzytgYqoxeYkspM66f47FenuK6HSjpCdSGAGLxxEKmM8tB3vEra",
            //     },
            //     body: JSON.stringify({
            //         //
            //     })
            // })
            //     .then(response => response.json())
            //     .then(data => console.log(data))
        }
    }
}
</script>