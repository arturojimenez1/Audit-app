<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const user = computed(() => usePage().props.auth.user);

const roleLabel = computed(() => {
    switch (user.value?.role) {
        case 'super_admin':
            return 'Super Administrador';
        case 'auditor':
            return 'Auditor';
        case 'client':
            return 'Usuario Cliente';
        default:
            return user.value?.role;
    }
});

const roleColor = computed(() => {
    switch (user.value?.role) {
        case 'super_admin':
            return 'bg-purple-100 text-purple-800 border-purple-300';
        case 'auditor':
            return 'bg-emerald-100 text-emerald-800 border-emerald-300';
        case 'client':
            return 'bg-blue-100 text-blue-800 border-blue-300';
        default:
            return 'bg-slate-100 text-slate-800 border-slate-300';
    }
});
</script>

<template>
    <Head title="Panel Principal - AuditPro" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                        Panel de Control
                    </h2>
                    <p class="text-xs text-slate-500 font-medium">Bienvenido al sistema de gestión y auditoría</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-xs text-slate-600 font-bold">Rol activo:</span>
                    <span :class="['px-3 py-1 rounded-md text-xs font-black uppercase tracking-wider border', roleColor]">
                        {{ roleLabel }}
                    </span>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <!-- Panel de Bienvenida con Datos del Usuario -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Hola, {{ user?.name }} 👋</h3>
                            <p class="text-sm text-slate-600">Sesión iniciada con <span class="font-semibold text-slate-900">{{ user?.email }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Módulos Disponibles por Rol -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <!-- Super Admin Module -->
                    <div class="bg-white border-2 rounded-2xl p-5 shadow-sm space-y-3" :class="user?.role === 'super_admin' ? 'border-purple-500' : 'border-slate-200 opacity-60'">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-0.5 rounded bg-purple-100 text-purple-800 text-[10px] font-black uppercase">Super Admin</span>
                            <span v-if="user?.role === 'super_admin'" class="text-xs font-bold text-emerald-600 flex items-center space-x-1">
                                <span>●</span>
                                <span>Acceso Total</span>
                            </span>
                            <span v-else class="text-xs font-bold text-slate-400">Restringido</span>
                        </div>
                        <h4 class="text-base font-bold text-slate-900">Gestión de Usuarios & Configuración</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Creación de auditores, asignación de permisos, administración de empresas y bitácoras del sistema.
                        </p>
                    </div>

                    <!-- Auditor Module -->
                    <div class="bg-white border-2 rounded-2xl p-5 shadow-sm space-y-3" :class="['super_admin', 'auditor'].includes(user?.role) ? 'border-emerald-500' : 'border-slate-200 opacity-60'">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-0.5 rounded bg-emerald-100 text-emerald-800 text-[10px] font-black uppercase">Auditor</span>
                            <span v-if="['super_admin', 'auditor'].includes(user?.role)" class="text-xs font-bold text-emerald-600 flex items-center space-x-1">
                                <span>●</span>
                                <span>Autorizado</span>
                            </span>
                            <span v-else class="text-xs font-bold text-slate-400">Restringido</span>
                        </div>
                        <h4 class="text-base font-bold text-slate-900">Módulo de Auditorías & Hallazgos</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Ejecución de auditorías, registro de evidencias, evaluación de controles y emisión de dictámenes.
                        </p>
                    </div>

                    <!-- Client Module -->
                    <div class="bg-white border-2 rounded-2xl p-5 shadow-sm space-y-3 border-blue-500">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-0.5 rounded bg-blue-100 text-blue-800 text-[10px] font-black uppercase">Cliente</span>
                            <span class="text-xs font-bold text-emerald-600 flex items-center space-x-1">
                                <span>●</span>
                                <span>Disponible</span>
                            </span>
                        </div>
                        <h4 class="text-base font-bold text-slate-900">Consulta de Reportes & Estado</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Visualización de resultados de auditoría, seguimiento a observaciones y descarga de informes finales.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

