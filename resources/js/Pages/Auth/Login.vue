<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
        default: true,
    },
    status: {
        type: String,
    },
});

const showPassword = ref(false);
const isCapsLockOn = ref(false);

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const checkCapsLock = (e) => {
    isCapsLockOn.value = e.getModifierState && e.getModifierState('CapsLock');
};

const setDemoCredentials = (email, password) => {
    form.email = email;
    form.password = password;
};

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Acceso Corporativo - AuditPro" />

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-10 bg-slate-100/90 font-sans selection:bg-emerald-600 selection:text-white">
        <!-- Master Container con estructura sólida de alta definición -->
        <div class="w-full max-w-5xl rounded-2xl bg-white border border-slate-300 shadow-2xl overflow-hidden grid lg:grid-cols-12 min-h-[620px]">
            
            <!-- Lado Izquierdo: Panel Corporativo Verde Esmeralda (5 columnas) -->
            <div class="lg:col-span-5 p-8 sm:p-10 flex flex-col justify-between bg-emerald-950 border-r border-emerald-900 text-white relative">
                <!-- Sutil patrón de líneas geométricas -->
                <div class="absolute inset-0 opacity-[0.03] bg-[linear-gradient(to_right,#ffffff_1px,transparent_1px),linear-gradient(to_bottom,#ffffff_1px,transparent_1px)] bg-[size:20px_20px] pointer-events-none"></div>

                <!-- Header Branding -->
                <div class="relative z-10">
                    <div class="flex items-center space-x-3">
                        <div class="w-11 h-11 rounded-xl bg-emerald-500 flex items-center justify-center text-emerald-950 font-black shadow-lg shadow-emerald-500/20">
                            <svg class="w-6 h-6 text-slate-950" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-2xl font-black tracking-tight text-white">Audit<span class="text-emerald-400">Pro</span></span>
                            <span class="block text-[10px] font-bold tracking-widest uppercase text-emerald-400">Enterprise Edition</span>
                        </div>
                    </div>
                </div>

                <!-- Contenido Central -->
                <div class="relative z-10 my-8 space-y-6">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-md bg-emerald-900 border border-emerald-800 text-emerald-300 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Servidor Seguro Conectado</span>
                    </div>

                    <h2 class="text-3xl font-extrabold text-white leading-tight">
                        Supervisión integral y control de auditoría.
                    </h2>
                    
                    <p class="text-emerald-100/90 text-sm leading-relaxed">
                        Controla procesos, genera trazabilidad de cambios y gestiona bitácoras con autenticación segura en tiempo real.
                    </p>

                    <!-- Tarjeta de Beneficios y Métricas -->
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <div class="p-3.5 rounded-xl bg-emerald-900/60 border border-emerald-800/80">
                            <div class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Cumplimiento</div>
                            <div class="text-base font-extrabold text-white mt-0.5">ISO / SOX Ready</div>
                        </div>
                        <div class="p-3.5 rounded-xl bg-emerald-900/60 border border-emerald-800/80">
                            <div class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Cifrado</div>
                            <div class="text-base font-extrabold text-white mt-0.5">AES-256 Bit</div>
                        </div>
                    </div>
                </div>

                <!-- Footer del panel -->
                <div class="relative z-10 flex items-center justify-between text-xs text-emerald-400/80 border-t border-emerald-900 pt-4 font-medium">
                    <span>AuditPro Cloud v2.4</span>
                    <span>&copy; {{ new Date().getFullYear() }}</span>
                </div>
            </div>

            <!-- Lado Derecho: Formulario en Blanco con Colores Definidos (7 columnas) -->
            <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white">
                <div class="max-w-md w-full mx-auto space-y-6">
                    
                    <!-- Encabezado Formulario -->
                    <div class="space-y-1">
                        <div class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase tracking-wider mb-1">
                            <span>🔐</span>
                            <span>Portal de Autenticación</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Iniciar Sesión
                        </h1>
                        <p class="text-sm text-slate-600 font-medium">
                            Ingresa tus credenciales corporativas para continuar.
                        </p>
                    </div>

                    <!-- Mensaje de estado -->
                    <div v-if="status" class="p-3.5 rounded-lg bg-emerald-50 border-2 border-emerald-300 text-emerald-900 text-sm font-semibold flex items-center space-x-2">
                        <svg class="w-5 h-5 text-emerald-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ status }}</span>
                    </div>

                    <!-- Formulario -->
                    <form @submit.prevent="submit" class="space-y-4">
                        
                        <!-- Correo Electrónico -->
                        <div class="space-y-1.5">
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Correo Electrónico
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input
                                    id="email"
                                    type="email"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    placeholder="nombre@empresa.com"
                                    autocomplete="username"
                                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:outline-none focus:border-emerald-600 transition-colors"
                                    :class="{ 'border-rose-500 bg-rose-50/50 text-rose-900': form.errors.email }"
                                />
                            </div>
                            <p v-if="form.errors.email" class="text-xs font-bold text-rose-600 mt-1 flex items-center space-x-1">
                                <svg class="w-4 h-4 text-rose-500 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ form.errors.email }}</span>
                            </p>
                        </div>

                        <!-- Contraseña -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                    Contraseña
                                </label>
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="text-xs font-bold text-emerald-700 hover:text-emerald-800 hover:underline transition-colors"
                                >
                                    ¿Olvidaste tu contraseña?
                                </Link>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input
                                    id="password"
                                    :type="showPassword ? 'text' : 'password'"
                                    v-model="form.password"
                                    @keyup="checkCapsLock"
                                    @keydown="checkCapsLock"
                                    required
                                    placeholder="••••••••"
                                    autocomplete="current-password"
                                    class="w-full pl-11 pr-11 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 text-sm font-medium focus:bg-white focus:outline-none focus:border-emerald-600 transition-colors"
                                    :class="{ 'border-rose-500 bg-rose-50/50 text-rose-900': form.errors.password }"
                                />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-700 transition-colors"
                                    tabindex="-1"
                                    title="Mostrar/Ocultar contraseña"
                                >
                                    <svg v-if="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Aviso de Bloq Mayús -->
                            <p v-if="isCapsLockOn" class="text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 rounded p-1.5 mt-1 flex items-center space-x-1">
                                <span>⚠️ Bloq Mayús está activado</span>
                            </p>

                            <!-- Error de Contraseña -->
                            <p v-if="form.errors.password" class="text-xs font-bold text-rose-600 mt-1 flex items-center space-x-1">
                                <svg class="w-4 h-4 text-rose-500 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ form.errors.password }}</span>
                            </p>
                        </div>

                        <!-- Checkbox Recuerdame -->
                        <div class="flex items-center pt-1">
                            <label class="flex items-center space-x-2.5 cursor-pointer select-none">
                                <input
                                    type="checkbox"
                                    v-model="form.remember"
                                    class="w-4 h-4 rounded border-2 border-slate-300 text-emerald-600 focus:ring-emerald-600 cursor-pointer"
                                />
                                <span class="text-xs text-slate-700 font-semibold">Mantener sesión iniciada</span>
                            </label>
                        </div>

                        <!-- Botón Sólido de Acción -->
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full mt-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 p-3.5 font-bold text-white shadow-lg shadow-emerald-700/20 transition-all duration-150 disabled:opacity-50 flex items-center justify-center space-x-2 cursor-pointer"
                        >
                            <svg v-if="form.processing" class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="text-sm font-extrabold tracking-wide">
                                {{ form.processing ? 'Verificando...' : 'Acceder al Sistema' }}
                            </span>
                            <svg v-if="!form.processing" class="w-4 h-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>

                    <!-- Link a Registro -->
                    <div class="text-center pt-3 border-t border-slate-200">
                        <p class="text-xs text-slate-600 font-semibold">
                            ¿No tienes una cuenta aún?
                            <Link :href="route('register')" class="text-emerald-700 font-extrabold hover:text-emerald-800 hover:underline ml-1">
                                Registrar nuevo usuario
                            </Link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>





