<template>
    <main class="bg-black text-gray-200 font-medium">

  <!-- header block -->
  <div class="bg-gray-900">
    <header class="max-w-screen-xl mx-auto px-6 lg:px-8 xl:px-4 py-4 lg:py-6 flex justify-between">
      <a href="#">
        <span class="sr-only">Safe2Car</span>
        <img class="h-10" src="../../landing/images/logo.svg" alt="">
      </a>
      <nav class="flex items-center space-x-4" v-if="canLogin">
            <inertia-link v-if="$page.props.user" href="/vehicle" class="inline-block bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-700 font-semibold rounded-lg py-2 px-5 text-white ">Entrar</inertia-link>
            <template v-else>
                <inertia-link :href="route('login')" class="flex space-x-1 items-center hover:text-white">
                    <svg class="hidden sm:inline w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Iniciar sesión</span>
                </inertia-link>
                <inertia-link v-if="canRegister" :href="route('register')" class="inline-block bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-700 font-semibold rounded-lg py-2 px-5 text-white ">Registro</inertia-link>
            </template>
      </nav>
    </header>
  </div>
  <!--/ header block -->

  <div class="py-12 md:py-24 bg-gradient-to-b from-gray-900 to-black">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-8 xl:px-4 grid md:grid-cols-4 xl:grid-cols-5 gap-x-12 lg:gap-x-20">
      <div class="order-2 md:order-1 col-span-2 self-center mt-12 md:mt-0">
        <h1 class="text-white text-3xl md:text-4xl lg:text-5xl font-bold mb-2 md:mb-4 lg:mb-8">La mejor forma de rastrear tu vehículo</h1>
        <p class="text-lg xl:text-xl text-gray-200 mb-6 lg:mb-8 xl:mb-10">Gps, cámara, bocina repulsiva, todo en un mismo dispositivo</p>
        <div class="flex space-x-4 mb-6">
          <button class="focus:outline-none inline-block bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-700 font-semibold rounded-lg py-2 px-5  text-white ">Registro</button>
        </div>
      </div>
      <div class="order-1 md:order-2 col-span-2 xl:col-span-3">
        <img src="../../landing/images/car.svg" class="rounded-lg shadow-2xl" alt="">
      </div>
    </div>
  </div>

  <!-- logo block -->
  <div class="py-12 lg:pb-16 bg-black mb-12 lg:mb-16  ">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-8 xl:px-4 grid grid-cols-2 sm:grid-cols-3 space-y-5 sm:space-y-3 xl:grid-cols-5 col-gap-6 opacity-95">
      <div class="flex flex-col justify-center items-stretch">
        <img class="h-16 p-1 mb-3" src="../../landing/images/navigation.svg" alt="">
        <p class="text-lg xl:text-xl text-gray-200 mt-2 text-center">Obtén la ubicación inmediatamente</p>
      </div>
      <div class="flex flex-col justify-center items-stretch">
        <img class="h-16 p-1 mb-3" src="../../landing/images/camera.svg" alt="">
        <p class="text-lg xl:text-xl text-gray-200 mt-2 text-center">Toma fotografías del interior al instante</p>
      </div>
      <div class="flex flex-col justify-center items-stretch">
        <img class="h-16 p-1 mb-3" src="../../landing/images/phone-call.svg" alt="">
        <p class="text-lg xl:text-xl text-gray-200 mt-2 text-center">Tu vehículo puede llamarte para escuchar lo que está ocurriendo</p>
      </div>
      <div class="flex flex-col justify-center">
        <img class="h-16 p-1 mb-3" src="../../landing/images/battery.svg" alt="">
        <p class="text-lg xl:text-xl text-gray-200 mt-2 text-center">Inmoviliza tu auto a distancia</p>
      </div>
      <div class="flex flex-col justify-center">
        <img class="h-16 p-1 mb-3" src="../../landing/images/motion-sensor.svg" alt="">
        <p class="text-lg xl:text-xl text-gray-200 mt-2 text-center">Sensores de movimiento alertarán en caso de robo</p>
      </div>
    </div>
  </div>
  <!--/ logo block -->





  <!-- footer block -->
  <footer class="bg-gray-900 text-gray-200 py-12 xl:pb-24">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-8 xl:px-4 mb-12 lg:mb-16">
      <img class="h-10" src="../../landing/images/logo.svg" alt="">
    </div>
    <div class="max-w-screen-xl mx-auto px-6 lg:px-8 xl:px-4 flex flex-col md:flex-row justify-between items-center space-y-4 mt-16 lg:mt-20">
      <div class="text-sm space-y-4 md:space-y-1 text-center md:text-left">
        <p>&copy;2021 SafeToCar Chile. Todos los derechos reservados</p>
        <p>Nota: Este no es un producto real</p>
      </div>
      <a href="#" class="inline-block bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-700 font-semibold rounded-lg py-4 px-5 lg:px-8 text-white md:transform md:-translate-y-2">Registrate Ahora</a>
    </div>
    <div class="max-w-screen-xl mx-auto px-6 lg:px-8 xl:px-4 flex flex-col md:flex-row justify-between items-center space-y-4 mt-8 lg:mt-12">
      <nav class="flex flex-wrap justify-center space-x-6">
        <a href="#" class=" text-sm hover:text-gray-700 mb-2">Privacidad</a>
        <a href="#" class=" text-sm hover:text-gray-700 mb-2">Terminos y Condiciones</a>
        <a href="#" class=" text-sm hover:text-gray-700 mb-2">Legal</a>
      </nav>
    </div>
  </footer>
  <!--/ footer block -->

</main>
</template>

<script>
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    }
</script>
<style scoped src="../../landing/css/main.css"></style>
