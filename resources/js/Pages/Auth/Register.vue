<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const showPassword = ref(false);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Crear Cuenta - AuditPro" />

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-10 bg-slate-100 font-sans selection:bg-emerald-600 selection:text-white">
        <!-- Master Container con Bordes Sólidos -->
        <div class="w-full max-w-5xl rounded-2xl bg-white border border-slate-300 shadow-xl overflow-hidden grid lg:grid-cols-12 min-h-[600px]">
            
            <!-- Lado Izquierdo: Panel Sólido Corporativo Verde Esmeralda (5 columnas) -->
            <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between bg-emerald-900 border-r border-emerald-950 text-white">
                
                <!-- Header Branding -->
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500 flex items-center justify-center text-white shadow-md">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-2xl font-bold tracking-tight text-white">Audit<span class="text-emerald-400">Pro</span></span>
                            <span class="block text-[11px] font-semibold tracking-wider uppercase text-emerald-300">Sistema de Control</span>
                        </div>
                    </div>
                </div>

                <!-- Contenido Central -->
                <div class="my-8 space-y-6">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-md bg-emerald-800 border border-emerald-700 text-emerald-200 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>Alta de Usuario Auditor</span>
                    </div>

                    <h2 class="text-3xl font-extrabold text-white leading-tight">
                        Comienza a supervisar tus procesos.
                    </h2>
                    
                    <p class="text-emerald-100 text-sm leading-relaxed">
                        Crea tu cuenta institucional y accede a herramientas de registro y verificación en tiempo real.
                    </p>
                </div>

                <!-- Footer del panel -->
                <div class="flex items-center justify-between text-xs text-emerald-300/80 border-t border-emerald-800/80 pt-4">
                    <span>AuditPro Enterprise</span>
                    <span>&copy; {{ new Date().getFullYear() }}</span>
                </div>
            </div>

            <!-- Lado Derecho: Formulario en Blanco con Bordes Sólidos (7 columnas) -->
            <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white overflow-y-auto">
                <div class="max-w-md w-full mx-auto space-y-5">
                    
                    <!-- Encabezado Formulario -->
                    <div class="space-y-1">
                        <div class="inline-block px-2.5 py-1 rounded bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-1">
                            Nuevo Registro
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                            Crear Cuenta
                        </h1>
                        <p class="text-sm text-slate-600">
                            Completa los datos para dar de alta tu acceso.
                        </p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-3.5">
                        <!-- Nombre -->
                        <div class="space-y-1">
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Nombre Completo
                            </label>
                            <input
                                id="name"
                                type="text"
                                v-model="form.name"
                                required
                                autofocus
                                placeholder="Ej. Juan Pérez"
                                autocomplete="name"
                                class="w-full px-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-lg text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:outline-none focus:border-emerald-600 transition-colors"
                                :class="{ 'border-rose-500 bg-rose-50': form.errors.name }"
                            />
                            <p v-if="form.errors.name" class="text-xs font-semibold text-rose-600 mt-1">{{ form.errors.name }}</p>
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Correo Electrónico
                            </label>
                            <input
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                placeholder="tu.correo@empresa.com"
                                autocomplete="username"
                                class="w-full px-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-lg text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:outline-none focus:border-emerald-600 transition-colors"
                                :class="{ 'border-rose-500 bg-rose-50': form.errors.email }"
                            />
                            <p v-if="form.errors.email" class="text-xs font-semibold text-rose-600 mt-1">{{ form.errors.email }}</p>
                        </div>

                        <!-- Contraseña -->
                        <div class="space-y-1">
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Contraseña
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    :type="showPassword ? 'text' : 'password'"
                                    v-model="form.password"
                                    required
                                    placeholder="••••••••"
                                    autocomplete="new-password"
                                    class="w-full px-4 pr-11 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-lg text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:outline-none focus:border-emerald-600 transition-colors"
                                    :class="{ 'border-rose-500 bg-rose-50': form.errors.password }"
                                />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-800"
                                    tabindex="-1"
                                >
                                    <svg v-if="!showPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                            <p v-if="form.errors.password" class="text-xs font-semibold text-rose-600 mt-1">{{ form.errors.password }}</p>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="space-y-1">
                            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Confirmar Contraseña
                            </label>
                            <input
                                id="password_confirmation"
                                type="password"
                                v-model="form.password_confirmation"
                                required
                                placeholder="••••••••"
                                autocomplete="new-password"
                                class="w-full px-4 py-2.5 bg-slate-50 border-2 border-slate-200 rounded-lg text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:outline-none focus:border-emerald-600 transition-colors"
                                :class="{ 'border-rose-500 bg-rose-50': form.errors.password_confirmation }"
                            />
                            <p v-if="form.errors.password_confirmation" class="text-xs font-semibold text-rose-600 mt-1">{{ form.errors.password_confirmation }}</p>
                        </div>

                        <!-- Botón Submit -->
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full mt-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 py-3.5 px-4 font-bold text-white shadow-md transition-colors disabled:opacity-50"
                        >
                            <span class="text-sm tracking-wide">
                                {{ form.processing ? 'Registrando...' : 'Crear Cuenta' }}
                            </span>
                        </button>
                    </form>

                    <div class="text-center pt-3 border-t border-slate-200">
                        <p class="text-xs text-slate-600 font-medium">
                            ¿Ya tienes una cuenta?
                            <Link :href="route('login')" class="text-emerald-700 font-bold hover:text-emerald-800 hover:underline ml-1">
                                Iniciar Sesión
                            </Link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>




