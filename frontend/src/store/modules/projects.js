import axios from 'axios';
const state = {
    projects: null,
};
const getters = { 
    stateProjects: state => state.projects,
};
const actions = {
    async createProject({dispatch}, project) {
        await axios.post('projects', {
            name: project.name,
            description: project.description
        })
        await dispatch('getProjects')
    },
    async updateProject({dispatch}, project) {
        await axios.post('projects/' + project.id, {
            name: project.name,
            description: project.description
        })
        await dispatch('getProjects')
    },
    async deleteProject({dispatch}, project) {
        await axios.delete('projects/' + project.id)
        await dispatch('getProjects')
    },
    async getProjects({ commit }){
        let response = await axios.get('projects')
        if (response.data.success && !!response.data.data.length) {
            commit('setProjects', response.data.data)
        } else {
            commit('setProjects', null)
        }
    },
};
const mutations = {
    setProjects(state, projects){
        state.projects = projects
    },
};
export default {
  state,
  getters,
  actions,
  mutations
};