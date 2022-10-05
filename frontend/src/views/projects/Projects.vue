<template>
    <div>
        <div v-if="user">
            <p>Hi {{user.username}}</p>
        </div>
        <div>
            Restricted Area! Only for auth users.
        </div>
        <div><hr></div>
        <div v-if="projects">
            <ul>
                <li v-for="project in projects" :key="project.id">
                    <router-link :to="'/projects/' + project.id">{{project.name}}</router-link>
                </li>
            </ul>
        </div>
        <div v-else>No projects yet.</div>
        <div><hr></div>
        <div>
            <form @submit.prevent="submitCreateProject">
                <div>
                    <input type="text" name="name" v-model="form.name" placeholder="Project Name">
                    <validation-errors :errors="validationErrors" error-key="name" v-if="validationErrors"></validation-errors>
                </div>
                <div>
                    <textarea name="description" v-model="form.description" placeholder="Project Description"></textarea>
                    <validation-errors :errors="validationErrors" error-key="description" v-if="validationErrors"></validation-errors>
                </div>
                <button type="submit">Create project</button>
            </form>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import ValidationErrors from "@/components/common/ValidationErrors";

export default {
    name: 'ProjectsPage',
    components: {
        ValidationErrors
    },
    data() {
        return {
            form: {
                name: '',
                description: '',
            },
            validationErrors: null
        };
    },
    created: function () {
        this.getProjects()
    },
    computed: {
        ...mapGetters({projects: "stateProjects", user: "stateUser"}),
    },
    methods: {
        ...mapActions(["createProject", "getProjects"]),
        async submitCreateProject() {
            try {
                await this.createProject(this.form);
                this.form = {name: null, description: null}
                this.validationErrors = null
            } catch (error) {
                if (error.response.status == 422){
                    this.validationErrors = error.response.data.errors;
                }
            }
        },  
    }
};
</script>

<style scoped>
* {
    box-sizing: border-box;
}
hr {
    width: 50%;
    margin-top: 30px;
    margin-bottom: 30px;
}
ul {
    list-style: none;
    padding-inline-start: 0;
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
input, textarea {
    margin: 5px;
    padding:10px;
    border-radius:30px;
}
#error {
    color: red;
}
</style>