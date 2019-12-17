<template>
    <aside v-if="user" id="slideout" class="card">
        <ul class="nav flex-column nav-pills">
            <li v-for="tab in tabs" :key="tab.route" class="nav-item">
                <router-link :to="{ name: tab.route }" class="nav-link" active-class="active">
                    <fa :icon="tab.icon" fixed-width/>
                    {{ tab.name }}
                </router-link>
            </li>
        </ul>
    </aside>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        middleware: 'auth',

        computed: {
            tabs () {
                return [
                    {
                        icon: 'clipboard-list',
                        name: this.$t('orders'),
                        route: 'orders.list'
                    },
                    {
                        icon: 'list-ul',
                        name: this.$t('products'),
                        route: 'products.list'
                    },
                    {
                      icon: 'cog',
                      name: this.$t('settings'),
                      route: 'settings.list'
                    }
                ]
            },
            ...mapGetters({
                user: 'auth/user'
            })
        }
    }
</script>

<style>
    .settings-card .card-body {
        padding: 0;
    }
    #slideout {
      max-width: 160px;
      min-height: 100vh;
      position: absolute;
      background: rgba(0,0,0,0.1);
    }
</style>

<style type="scss">

</style>
