<template>
    <div>
        <div v-if="user">
            <p>Hi {{user.username}}</p>
            <p>Restricted Area! Only for auth users.</p>
        </div>
        <div><hr></div>
        <div v-if="!editMode">
            <div>
                <h2>{{project.name}}</h2>
            </div>
            <div>
                <h3>{{project.description}}</h3>
            </div>
            <div>
                <button type="button" @click="editMode = !editMode">Edit</button>
                <button type="button" @click="submitDeleteProject">Delete</button>
            </div>
        </div>
        <div v-if="editMode">
            <form @submit.prevent="submitUpdateProject">
                <div>
                    <input type="text" name="name" v-model="project.name" placeholder="Project Name">
                    <validation-errors :errors="validationErrors" error-key="name" v-if="validationErrors"></validation-errors>
                </div>
                <div>
                    <textarea name="description" v-model="project.description" placeholder="Project Description"></textarea>
                    <validation-errors :errors="validationErrors" error-key="description" v-if="validationErrors"></validation-errors>
                </div>
                <div>
                    <button type="button" @click="editMode = !editMode">Cancel</button>
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex"
import ValidationErrors from "@/components/common/ValidationErrors";

export default {
    name: 'ShowProjectPage',
    components: {
        ValidationErrors
    },
    data() {
        return {
            project: {
                name: null,
                description: null,
            },
            editMode: false,
            validationErrors: null
        };
    },
    mounted() {
        this.setCurrentProject();
    },
    computed: {
        ...mapGetters({projects: "stateProjects", user: "stateUser"}),
    },
    methods: {
        ...mapActions(["updateProject", "deleteProject"]),
        async submitUpdateProject() {
            try {
                await this.updateProject(this.project)
                this.setCurrentProject()
                this.editMode = false
                this.validationErrors = null
            } catch (error) {
                if (error.response.status == 422){
                    this.validationErrors = error.response.data.errors;
                }
            }
        },  
        async submitDeleteProject() {
            try {
                await this.deleteProject(this.project)
                this.$router.push('/projects')
            } catch (error) {
                throw "Sorry you can't delete project now!"
            }
        }, 
        setCurrentProject() {
            this.project = this.projects.find(o => o.id === parseInt(this.$route.params.id))
        }
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
button {
    background-color: #fff;
    color: #000;
    padding: 12px 20px;
    cursor: pointer;
    border-radius:30px;
}
button:hover {
    border-color: #00d;
}
input, textarea {
    margin: 5px;
    padding:10px;
    border-radius:30px;
}
</style>