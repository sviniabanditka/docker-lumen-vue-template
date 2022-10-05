import RegisterPage from '@/views/auth/Register'
import LoginPage from '@/views/auth/Login'

export default [
      {
        path: '/register',
        name: "register",
        component: RegisterPage,
        meta: { guest: true },
      },
      {
        path: '/login',
        name: "login",
        component: LoginPage,
        meta: { guest: true },
      },
]