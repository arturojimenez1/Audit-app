<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const user = computed(() => usePage().props.auth.user);

const roleLabel = computed(() => {
    switch (user.value?.role) {
        case 'super_admin': return 'Super Administrador';
        case 'auditor': return 'Auditor';
        case 'client': return 'Usuario Cliente';
        default: return user.value?.role;
    }
});

const roleColor = computed(() => {
    switch (user.value?.role) {
        case 'super_admin': return 'bg-purple-100 text-purple-800 border-purple-300';
        case 'auditor': return 'bg-emerald-100 text-emerald-800 border-emerald-300';
        default: return 'bg-blue-100 text-blue-800 border-blue-300';
    }
});

const stats = computed(() => {
    if (user.value?.role === 'super_admin') {
        return [
            { label: 'Usuarios Activos', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>`, color: 'bg-purple-50 text-purple-600 border-purple-200' },
            { label: 'Auditorías Activas', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>`, color: 'bg-emerald-50 text-emerald-600 border-emerald-200' },
            { label: 'Hallazgos Abiertos', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>`, color: 'bg-amber-50 text-amber-600 border-amber-200' },
            { label: 'Reportes Generados', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>`, color: 'bg-blue-50 text-blue-600 border-blue-200' },
        ];
    }
    if (user.value?.role === 'auditor') {
        return [
            { label: 'Mis Auditorías', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>`, color: 'bg-emerald-50 text-emerald-600 border-emerald-200' },
            { label: 'Hallazgos Activos', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>`, color: 'bg-amber-50 text-amber-600 border-amber-200' },
            { label: 'Evidencias Cargadas', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>`, color: 'bg-blue-50 text-blue-600 border-blue-200' },
            { label: 'Completadas', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>`, color: 'bg-green-50 text-green-600 border-green-200' },
        ];
    }
    return [
        { label: 'Mis Reportes', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>`, color: 'bg-blue-50 text-blue-600 border-blue-200' },
        { label: 'Observaciones Pendientes', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>`, color: 'bg-amber-50 text-amber-600 border-amber-200' },
        { label: 'Auditorías Completadas', value: '—', icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>`, color: 'bg-green-50 text-green-600 border-green-200' },
    ];
});
</script>

<template>
    <Head title="Panel Principal - AuditPro" />

    <AppLayout>
        <!-- Header slot del topbar -->
        <template #header>
            <div>
                <h1 class="text-base font-extrabold text-slate-900 leading-none">Panel Principal</h1>
                <p class="text-xs text-slate-500 font-medium mt-0.5">Resumen de actividad del sistema</p>
            </div>
        </template>

        <!-- Contenido de la página -->
        <div class="p-6 space-y-6">

            <!-- Bienvenida -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900">
                        Bienvenido, {{ user?.name }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Estás accediendo como
                        <span :class="['inline-flex items-center px-2 py-0.5 rounded text-xs font-black border ml-1', roleColor]">
                            {{ roleLabel }}
                        </span>
                    </p>
                </div>
                <div class="hidden sm:flex flex-col items-end text-right space-y-0.5">
                    <p class="text-xs text-slate-500 font-medium">{{ user?.email }}</p>
                    <p class="text-xs text-slate-400">
                        {{ new Date().toLocaleDateString('es-MX', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }) }}
                    </p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div :class="['grid gap-4', stats.length === 4 ? 'grid-cols-2 lg:grid-cols-4' : 'grid-cols-1 sm:grid-cols-3']">
                <div
                    v-for="stat in stats"
                    :key="stat.label"
                    class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center space-x-4 hover:border-slate-300 hover:shadow-sm transition-all"
                >
                    <div :class="['w-11 h-11 rounded-xl flex items-center justify-center border flex-shrink-0', stat.color]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" v-html="stat.icon" />
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 leading-none">{{ stat.label }}</p>
                        <p class="text-2xl font-extrabold text-slate-900 mt-1 leading-none">{{ stat.value }}</p>
                    </div>
                </div>
            </div>

            <!-- Actividad Reciente (placeholder) -->
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                    <h3 class="text-sm font-extrabold text-slate-900">Actividad Reciente</h3>
                    <span class="text-xs text-slate-400 font-medium">Últimas 24 horas</span>
                </div>
                <div class="divide-y divide-slate-50">
                    <div
                        v-for="i in 4"
                        :key="i"
                        class="flex items-center space-x-4 px-6 py-4"
                    >
                        <div class="w-9 h-9 rounded-xl bg-slate-100 flex-shrink-0 animate-pulse"></div>
                        <div class="flex-1 space-y-1.5">
                            <div class="h-3 bg-slate-100 rounded w-2/5 animate-pulse"></div>
                            <div class="h-2.5 bg-slate-50 rounded w-3/5 animate-pulse"></div>
                        </div>
                        <div class="h-2.5 bg-slate-100 rounded w-16 animate-pulse"></div>
                    </div>
                </div>
                <div class="px-6 py-3 border-t border-slate-100 bg-slate-50/50">
                    <p class="text-xs text-slate-400 font-medium text-center">Los registros de actividad estarán disponibles cuando existan operaciones en el sistema.</p>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
