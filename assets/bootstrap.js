//import { startStimulusApp } from '@symfony/stimulus-bundle';

//const app = startStimulusApp();
// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

import { Application } from "stimulus";
import { definitionsFromContext } from "stimulus/webpack-helpers";

// Crea una instancia de la aplicación Stimulus
const application = Application.start();

// Carga los controladores desde la carpeta "controllers"
const context = require.context('./controllers', true, /\.js$/);
application.load(definitionsFromContext(context));
