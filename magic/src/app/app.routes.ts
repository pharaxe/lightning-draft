import {Routes} from '@angular/router';
import {ArenaGridComponent} from './arena-grid/arena-grid.component';


export const AppRoutes: Routes = [
   { path: '', component: ArenaGridComponent, pathMatch: 'full' },
   { path: 'draft/:id', component: ArenaGridComponent },
   { path: '**', redirectTo: ''}
];
