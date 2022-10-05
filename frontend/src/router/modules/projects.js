import ProjectsPage from '@/views/projects/Projects'
import ShowProjectPage from '@/views/projects/ShowProject'

export default [
    {
        path: '/projects',
        name: 'projects',
        component: ProjectsPage,
        meta: {requiresAuth: true},
    },
    {
        path: '/projects/:id',
        name: 'showProject',
        component: ShowProjectPage,
        meta: {requiresAuth: true},
    }
]
