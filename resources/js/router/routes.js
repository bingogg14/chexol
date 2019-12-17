const Welcome = () => import('~/pages/welcome').then(m => m.default || m)
const Login = () => import('~/pages/auth/login').then(m => m.default || m)
const Register = () => import('~/pages/auth/register').then(m => m.default || m)
const PasswordEmail = () => import('~/pages/auth/password/email').then(m => m.default || m)
const PasswordReset = () => import('~/pages/auth/password/reset').then(m => m.default || m)
const NotFound = () => import('~/pages/errors/404').then(m => m.default || m)

const Home = () => import('~/pages/home').then(m => m.default || m)
const Settings = () => import('~/pages/settings/index').then(m => m.default || m)
const SettingsProfile = () => import('~/pages/settings/profile').then(m => m.default || m)
const SettingsPassword = () => import('~/pages/settings/password').then(m => m.default || m)

const ProductsList = () => import('~/pages/products/list').then(m => m.default || m)

const OrdersList = () => import('~/pages/orders/list').then(m => m.default || m)

export default [
  { path: 'admin/api/v0/', name: 'welcome', component: Welcome },

  { path: '/admin/api/v0/login', name: 'login', component: Login },
  { path: '/admin/api/v0/register', name: 'register', component: Register },
  { path: '/admin/api/v0/password/reset', name: 'password.request', component: PasswordEmail },
  { path: '/admin/api/v0/password/reset/:token', name: 'password.reset', component: PasswordReset },

  { path: '/admin/api/v0/home', name: 'home', component: Home },
  { path: '/admin/api/v0/settings',
    component: Settings,
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: SettingsProfile },
      { path: 'password', name: 'settings.password', component: SettingsPassword }
    ] },
  { path: '/admin/api/v0/products',
    name: 'products.list',
    component: ProductsList,
    children: [
      { path: '', redirect: { name: 'products.list' } }
    ] },
  { path: '/admin/api/v0/orders',
    name: 'orders.list',
    component: OrdersList,
    children: [
      { path: '', redirect: { name: 'orders.list' } }
    ] },

  { path: '/admin/api/v0/*', component: NotFound }
]
