<template>
    <v-navigation-drawer
        app
        clipped
        v-model="DRAWER_STATE"
        :mini-variant="!DRAWER_STATE"
        :width="sidebarWidth"
        :permanent="$vuetify.breakpoint.mdAndUp"
        :temporary="$vuetify.breakpoint.smAndDown"
        :mini-variant-width="sidebarMinWidth"
        :class="{'drawer-mini': !DRAWER_STATE}">
        <v-list>
            <template v-for="(item, i) in items">
                <v-row
                    v-if="item.heading"
                    :key="item.heading"
                    align="center">
                    <v-col
                        cols="6"
                        class="py-5">
       <span style="padding-left: 32px" class="text-body-1 subheader" :class="(item.heading && DRAWER_STATE) ? 'show ' : 'hide'">
        {{ item.heading }}
       </span>
                    </v-col>
                    <v-col
                        cols="6"
                        class="text-center">
                    </v-col>
                </v-row>
                <v-divider
                    v-else-if="item.divider"
                    :key="i"
                    dark
                    class="my-4"></v-divider>
                <v-list-group
                    class="haveChild"
                    color="primary"
                    v-else-if="item.children && DRAWER_STATE"
                    :key="item.title"
                    v-model="item.model">
                    <template v-slot:prependIcon>
                        <v-icon >{{item.icon}}</v-icon>
                    </template>
                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title class="grey--text">
                                {{ item.title }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </template>
                    <Link v-for="(child, i) in item.children"
                          :key="i" :href="child.link">
                    <v-list-item

                        >
                        <v-list-item-action v-if="child.icon">
                            <v-icon >{{ child.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="grey--text">
                                {{ child.title }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    </Link>
                </v-list-group>
                <Link v-else
                      :key="item.text" :href="item.link === '#' ? null : item.link">
                <v-list-item
                    color="primary"

                    >
                    <v-list-item-action class="m-2">
                        <v-icon

                            :color="item.color ? item.color : ''">{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title
                            class="grey--text body-2 font-weight-bold"
                            link>
                            {{ item.title }}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                </Link>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>
<script>
import {mapActions, mapState} from 'vuex'
import { Link } from '@inertiajs/vue2'

export default {
    props: {
        source: String,
    },
    components: {
        Link,
    },
    data(){
        return {
            items: [


                {
                    title: 'transactions',
                    icon: 'mdi-cards',
                    link: '/transaction',
                },

                {
                    title: 'payment',
                    icon: 'mdi-cash',
                    link: '/payment',
                },
                { divider: true },
                {
                    title: 'reports',
                    icon: 'mdi-cash',
                    link: '/reports',
                },

            ],
            sidebarWidth: 280,
            sidebarMinWidth: 96
        }
    },
    computed: {
        ...mapState(['drawer']),
        DRAWER_STATE: {
            get() {
                return this.drawer
            },
            set(newValue) {
                if (newValue === this.drawer) return;
                this.TOGGLE_DRAWER();
            }
        }
    },
    methods: {
        ...mapActions([ 'TOGGLE_DRAWER' ]),
    }
}
</script>
<style src="./Sidebar.scss" lang="scss"></style>

