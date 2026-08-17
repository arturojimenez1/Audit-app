<script setup>
import { ref, computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';

const page = usePage();
const user = computed(() => page.props.auth.user);
const sidebarOpen = ref(false);
const userMenuOpen = ref(false);

const roleLabel = computed(() => {
    switch (user.value?.role) {
        case 'super_admin': return 'Super Admin';
        case 'auditor': return 'Auditor';
        case 'client': return 'Cliente';
        default: return user.value?.role ?? '';
    }
});

const roleColor = computed(() => {
    switch (user.value?.role) {
        case 'super_admin': return 'bg-purple-500/20 text-purple-300 border-purple-500/30';
        case 'auditor': return 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30';
        default: return 'bg-blue-500/20 text-blue-300 border-blue-500/30';
    }
});

const initials = computed(() => {
    return (user.value?.name ?? 'U')
        .split(' ')
        .map(w => w[0])
        .slice(0, 2)
        .join('')
        .toUpperCase();
});

const logout = () => {
    router.post(route('logout'));
};

// Nav items por rol
const navItems = computed(() => {
    const role = user.value?.role;
    const all = [
        {
            label: 'Panel Principal',
            route: 'dashboard',
            icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>`,
            roles: ['super_admin', 'auditor', 'client'],
        },
        {
            label: 'Usuarios',
            route: 'dashboard',
            icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>`,
            roles: ['super_admin'],
        },
        {
            label: 'Auditorías',
            route: 'dashboard',
            icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>`,
            roles: ['super_admin', 'auditor'],
        },
        {
            label: 'Hallazgos',
            route: 'dashboard',
            icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>`,
            roles: ['super_admin', 'auditor'],
        },
        {
            label: 'Evidencias',
            route: 'dashboard',
            icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>`,
            roles: ['super_admin', 'auditor'],
        },
        {
            label: 'Mis Reportes',
            route: 'dashboard',
            icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>`,
            roles: ['super_admin', 'auditor', 'client'],
        },
        {
            label: 'Configuración',
            route: 'dashboard',
            icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>`,
            roles: ['super_admin'],
        },
    ];
    return all.filter(item => item.roles.includes(role));
});

const isActive = (routeName) => {
    return page.url.startsWith('/' + routeName.replace('.', '/'))
        || (routeName === 'dashboard' && page.url === '/dashboard');
};
</script>

<template>
    <div class="min-h-screen flex bg-slate-50 font-sans">

        <!-- Overlay para móvil -->
        <div
            v-if="sidebarOpen"
            class="fixed inset-0 z-20 bg-black/40 lg:hidden"
            @click="sidebarOpen = false"
        ></div>

        <!-- ======================== SIDEBAR ======================== -->
        <aside
            :class="[
                'fixed inset-y-0 left-0 z-30 flex flex-col w-64 bg-slate-950 border-r border-slate-800 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0',
                sidebarOpen ? 'translate-x-0' : '-translate-x-full'
            ]"
        >
            <!-- Logo -->
            <div class="flex items-center space-x-3 px-5 py-5 border-b border-slate-800/80">
                <div class="w-9 h-9 rounded-xl bg-emerald-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-slate-950" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <span class="text-lg font-black tracking-tight text-white">Audit<span class="text-emerald-400">Pro</span></span>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Enterprise</p>
                </div>
            </div>

            <!-- Nav Items -->
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">
                <template v-for="item in navItems" :key="item.label">
                    <Link
                        :href="route(item.route)"
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150"
                        :class="isActive(item.route)
                            ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-700/20'
                            : 'text-slate-400 hover:text-white hover:bg-slate-800'"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" v-html="item.icon" />
                        <span>{{ item.label }}</span>
                    </Link>
                </template>
            </nav>

            <!-- User Footer en Sidebar -->
            <div class="p-3 border-t border-slate-800/80">
                <div class="flex items-center space-x-3 px-3 py-2.5 rounded-xl bg-slate-900">
                    <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white text-xs font-black flex-shrink-0">
                        {{ initials }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-white truncate">{{ user?.name }}</p>
                        <span :class="['text-[10px] font-bold px-1.5 py-0.5 rounded border', roleColor]">
                            {{ roleLabel }}
                        </span>
                    </div>
                    <button @click="logout" title="Cerrar sesión" class="text-slate-500 hover:text-rose-400 transition-colors flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </div>
        </aside>

        <!-- ======================== MAIN AREA ======================== -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- TOPBAR -->
            <header class="sticky top-0 z-10 bg-white border-b border-slate-200 px-4 sm:px-6">
                <div class="flex items-center justify-between h-16">
                    <!-- Hamburger para móvil + Breadcrumb -->
                    <div class="flex items-center space-x-3">
                        <button
                            class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors"
                            @click="sidebarOpen = !sidebarOpen"
                        >
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <!-- Slot para título de página -->
                        <div>
                            <slot name="header" />
                        </div>
                    </div>

                    <!-- Acciones del topbar derecho -->
                    <div class="flex items-center space-x-3">
                        <!-- Notificaciones -->
                        <button class="relative p-2 rounded-xl text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full"></span>
                        </button>

                        <!-- Avatar + menú -->
                        <div class="relative">
                            <button
                                @click="userMenuOpen = !userMenuOpen"
                                class="flex items-center space-x-2.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors"
                            >
                                <div class="w-7 h-7 rounded-lg bg-emerald-600 flex items-center justify-center text-white text-xs font-black">
                                    {{ initials }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <p class="text-xs font-bold text-slate-800 leading-none">{{ user?.name }}</p>
                                    <p class="text-[10px] text-slate-500 mt-0.5">{{ roleLabel }}</p>
                                </div>
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                v-if="userMenuOpen"
                                class="absolute right-0 mt-2 w-52 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden z-20"
                                @click.outside="userMenuOpen = false"
                            >
                                <div class="px-4 py-3 border-b border-slate-100">
                                    <p class="text-xs font-bold text-slate-800 truncate">{{ user?.name }}</p>
                                    <p class="text-xs text-slate-500 truncate">{{ user?.email }}</p>
                                </div>
                                <div class="p-1">
                                    <Link
                                        :href="route('profile.edit')"
                                        class="flex items-center space-x-2.5 px-3 py-2 rounded-lg text-sm text-slate-700 font-medium hover:bg-slate-50 transition-colors"
                                        @click="userMenuOpen = false"
                                    >
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>Mi Perfil</span>
                                    </Link>
                                    <hr class="my-1 border-slate-100">
                                    <button
                                        @click="logout"
                                        class="w-full flex items-center space-x-2.5 px-3 py-2 rounded-lg text-sm text-rose-600 font-semibold hover:bg-rose-50 transition-colors"
                                    >
                                        <svg class="w-4 h-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>Cerrar Sesión</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 overflow-y-auto">
                <slot />
            </main>
        </div>
    </div>
</template>
