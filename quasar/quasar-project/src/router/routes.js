const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/SelectUniqueAccess.vue') },
      { path: 'HomeVendedor', component: () => import('pages/HomePageVendedor.vue') },
      { path: 'HomeGestor', component: () => import('pages/HomePageGestor.vue') },
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
