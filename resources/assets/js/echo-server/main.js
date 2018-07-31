import Echo from "laravel-echo"

window.echo = Echo({
    broadcaster: "socket.io",
    connector: "socket.io",
    host: window.location.hostname + ":6002",
    namespace: 'App\\Repositories'
})