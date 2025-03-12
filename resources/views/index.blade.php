    @include('layout.navbar')

    <header class="jumbotron text-center bg-white text-dark">
        <div class="container">
            <h1 class="display-4">Optimiza tu flujo de trabajo con JIRA</h1>
            <p class="lead">La herramienta líder en gestión de proyectos y equipos. Mejora la colaboración, automatiza procesos y escala con confianza.</p>
            <a href="#" class="btn btn-dark btn-lg">Solicitar una Demo</a>
        </div>
    </header>

    <section class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>¿Qué es JIRA?</h2>
                <p>
                    JIRA es una plataforma de gestión de proyectos diseñada para ayudar a los equipos a planificar, rastrear y entregar proyectos con éxito. 
                    Ideal para metodologías ágiles, permite gestionar tareas, reportar incidencias y optimizar el flujo de trabajo en cualquier industria.
                </p>
                <ul>
                    <li>Gestión ágil de proyectos</li>
                    <li>Automatización de flujos de trabajo</li>
                    <li>Integraciones con cientos de herramientas</li>
                    <li>Escalabilidad para equipos grandes y pequeños</li>
                </ul>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/new-collaborate-4.png') }}" class="img-fluid" alt="JIRA Dashboard">
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Principales Funcionalidades</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gestión Ágil</h5>
                            <p class="card-text">Organiza tareas con tableros Kanban y Scrum, agilizando la colaboración entre equipos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Automatización</h5>
                            <p class="card-text">Ahorra tiempo con reglas automatizadas que eliminan tareas repetitivas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Integraciones</h5>
                            <p class="card-text">Conéctalo con Slack, GitHub, Confluence, y más para una experiencia unificada.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <h2 class="text-center mb-4">Empresas que confían en JIRA</h2>
        <div class="row text-center">
            <div class="col-md-3">
                <img src="{{ asset('img/index1.jpg') }}" class="img-fluid" alt="Empresa 1">
            </div>
            <div class="col-md-3">
                <img src="{{ asset('img/index2.png') }}" class="img-fluid" alt="Empresa 2">
            </div>
            <div class="col-md-3">
                <img src="{{ asset('img/index3.png') }}" class="img-fluid" alt="Empresa 3">
            </div>
            <div class="col-md-3">
                <img src="{{ asset('img/index4.png') }}" class="img-fluid" alt="Empresa 4">
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Lo que dicen nuestros clientes</h2>
            <div class="row">
                <div class="col-md-4">
                    <blockquote class="blockquote">
                        <p>"JIRA nos ayudó a escalar nuestro desarrollo ágil de manera eficiente y organizada."</p>
                        <footer class="blockquote-footer">María López, CTO de TechCorp</footer>
                    </blockquote>
                </div>
                <div class="col-md-4">
                    <blockquote class="blockquote">
                        <p>"La integración con otras herramientas ha sido clave para optimizar nuestra productividad."</p>
                        <footer class="blockquote-footer">Carlos Fernández, Product Manager</footer>
                    </blockquote>
                </div>
                <div class="col-md-4">
                    <blockquote class="blockquote">
                        <p>"El mejor software de gestión de proyectos que hemos usado. Sencillo y potente."</p>
                        <footer class="blockquote-footer">Lucía Gómez, CEO de StartUpX</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 JIRA Atlassian | Todos los derechos reservados</p>
    </footer>

