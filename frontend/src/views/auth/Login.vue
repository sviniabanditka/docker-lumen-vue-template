<template>
    <div class="login">
        <div>
            <form @submit.prevent="submit">
                <div>
                    <input type="text" name="email" v-model="form.email" placeholder="Username or Email">
                    <validation-errors :errors="validationErrors" error-key="email" v-if="validationErrors"></validation-errors>
                </div>
                <div>
                    <input type="password" name="password" v-model="form.password" placeholder="Password">
                    <validation-errors :errors="validationErrors" error-key="password" v-if="validationErrors"></validation-errors>
                </div>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import ValidationErrors from "@/components/common/ValidationErrors";

export default {
    name: "LoginPage",
    components: {
        ValidationErrors
    },
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            validationErrors: null
        };
    },
    methods: {
        ...mapActions(["login"]),
        async submit() {
            try {
                await this.login(this.form);
                this.validationErrors = null
                this.$router.push("/projects");
            } catch (error) {
                if (error.response.status == 422){
                    this.validationErrors = error.response.data.errors;
                }
            }
        },
    },
};
</script>

<style scoped>
* {
    box-sizing: border-box;
}
label {
    padding: 12px 12px 12px 0;
    display: inline-block;
}
button[type=submit] {
    background-color: #fff;
    color: #000;
    padding: 12px 20px;
    cursor: pointer;
    border-radius:30px;
}
button[type=submit]:hover {
    border-color: #00d;
}
input {
    margin: 5px;
    padding:10px;
    border-radius:30px;
}
#error {
    color: red;
}
</style>