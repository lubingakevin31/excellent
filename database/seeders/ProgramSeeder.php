<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'order_number' => 1,
                'title' => 'Éducation',
                'slug' => 'education',
                'target_audience' => 'Jeunes & Enfants (8-28 ans)',
                'short_description' => 'Soutien, formations, activités socio-éducatives et accompagnement familial.',
            ],
            [
                'order_number' => 2,
                'title' => 'Investissement & Architecture',
                'slug' => 'investissement-architecture',
                'target_audience' => 'Décideurs & Projets',
                'short_description' => 'Études, conception et appui technique aux infrastructures et ingénierie.',
            ],
            [
                'order_number' => 3,
                'title' => 'Hygiène & Santé',
                'slug' => 'hygiene-sante',
                'target_audience' => 'Communautés',
                'short_description' => 'Sensibilisation et amélioration des conditions sanitaires locales.',
            ],
            [
                'order_number' => 4,
                'title' => 'WASH (Eau & Environnement)',
                'slug' => 'wash-eau-environnement',
                'target_audience' => 'Communautés & Villes',
                'short_description' => 'Gestion des ressources en eau, assainissement et protection environnementale.',
            ],
            [
                'order_number' => 5,
                'title' => 'Leadership & Management',
                'slug' => 'leadership-management',
                'target_audience' => 'Cadres & Jeunes Leaders',
                'short_description' => 'Formations et conseils stratégiques en organisation et gestion.',
            ],
            [
                'order_number' => 6,
                'title' => 'Programme de Recherche',
                'slug' => 'programme-de-recherche',
                'target_audience' => 'Acteurs institutionnels',
                'short_description' => 'Analyses et propositions de stratégies basées sur la création de valeur.',
            ],
            [
                'order_number' => 7,
                'title' => 'Violences Basées sur le Genre (VBG)',
                'slug' => 'violences-basees-sur-le-genre',
                'target_audience' => 'Personnel, Partenaires & Communautés',
                'short_description' => 'Protection, prévention active, code de conduite strict, signalement confidentiel et orientation des victimes.',
                'full_description' => "Ce programme intègre la lutte contre les violences basées sur le genre (VBG). Il vise à garantir un environnement de travail protégé exempt de toute forme de harcèlement ou d'abus.\n\nSes axes principaux reposent sur la prévention active et la sensibilisation lors des projets communautaires. Un code de conduite strict est obligatoire pour l'ensemble du personnel, des consultants et des partenaires.\n\nUn mécanisme de signalement confidentiel est mis en place pour recueillir les plaintes en toute sécurité. Les victimes identifiées bénéficient d'une écoute bienveillante et d'une orientation rapide vers des structures spécialisées.",
            ],
        ];

        foreach ($programs as $program) {
            Program::updateOrCreate(['order_number' => $program['order_number']], $program);
        }
    }
}