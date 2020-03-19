<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand font-weight-bold" href="#">Overseer!</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            </div>
        </nav>

        <div class="row">
            <div class="col-12 hits-container mt-5">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Timestamp</th>
                        <th scope="col">Path</th>
                        <th scope="col">Method</th>
                        <th scope="col">Request IP</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="hit in endpointHits" :key="hit.id">
                        <th scope="row">{{hit.id}}</th>
                        <td class="text-muted">{{ hit.created_at }}</td>
                        <td class="font-weight-bold">{{ hit.path }}</td>
                        <td>{{ hit.method }}</td>
                        <td>{{ hit.request_ip }}</td>
                        <td v-if="Number(hit.response_code) <= 202" class="text-success font-weight-bold">
                            {{ hit.response_code }}
                        </td>
                        <td v-else-if="Number(hit.response_code) <= 308" class="text-info font-weight-bold">
                            {{ hit.response_code }}
                        </td>
                        <td v-else-if="Number(hit.response_code) <= 418" class="text-orange font-weight-bold">
                            {{hit.response_code}}
                        </td>
                        <td v-else class="text-danger font-weight-bold">
                            {{hit.response_code}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style>
    body, .navbar {
        background-color: #e3e3ec !important;
    }
    thead th {
        border-top: none;
    }
    .hits-container {
        background-color: #fff;
        border-radius: 3px;
    }
    .hits-container td {
        padding-top: 0.90rem;
        border-top: 1px solid #f1f1f1;
    }
    .text-orange {
        color: #f6993f;
    }
</style>

<script>
    export default
    {
        data() {
            return {
                endpointHits: [
                    {
                        id: 1,
                        created_at: "2020-03-18 20:41:00",
                        path: "/api/recipes",
                        method: "POST",
                        request_ip: "127.0.0.1",
                        response_code: "400"
                    },
                    {
                        id: 2,
                        created_at: "2020-03-18 20:41:00",
                        path: "/api/recipes",
                        method: "POST",
                        request_ip: "127.0.0.1",
                        response_code: "201"
                    },
                    {
                        id: 3,
                        created_at: "2020-03-18 20:41:00",
                        path: "/api/recipes",
                        method: "POST",
                        request_ip: "127.0.0.1",
                        response_code: "500"
                    },
                    {
                        id: 4,
                        created_at: "2020-03-18 20:41:00",
                        path: "/api/recipes/1",
                        method: "GET",
                        request_ip: "127.0.0.1",
                        response_code: "200"
                    },
                ]
            }
        }
    }
</script>
