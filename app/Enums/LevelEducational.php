<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum LevelEducational: int implements HasLabel, HasColor
{
    case PREPARATION_OF_QUALIFIED_WORKERS = 1; // Подготовка квалифицированных рабочих, служащих
    case MIDDLE_LEVEL_SPECIALIST_TRAINING = 2; // Программа подготовки специалистов среднего звена
    case BACHELOR = 3; // Бакалавриат
    case MASTER = 4; // Магистратура
    case SPECIALIST = 5; // Специалитет
    case POSTGRADUATE = 6; // Аспирантура
    case ADJUNCTURE = 7; // Адъюнктура
    case RESIDENCY = 8; // Ординатура
    case INTERNSHIP = 9; // Ассистентура - стажировка
    case PROFESSIONAL_TRAINING = 10; // Профессиональная подготовка по профессиям рабочих, должностям служащих
    case RETRAINING = 11; // Переподготовка рабочих, служащих
    case ADVANCED_TRAINING = 12; // Повышение квалификации рабочих, служащих
    case ADDITIONAL_GENERAL_DEVELOPMENT_PROGRAM = 13; // Дополнительная общеразвивающая программа
    case ADDITIONAL_PREPROFESSIONAL_PROGRAM = 14; // Дополнительная предпрофессиональная программа
    case ADDITIONAL_PREPROFESSIONAL_ART_PROGRAM = 15; // Дополнительная предпрофессиональная программа в сфере искусств
    case PROFESSIONAL_ADVANCEMENT = 16; // Повышение квалификации
    case PROFESSIONAL_RETRAINING = 17; // Профессиональная переподготовка
    case PRESCHOOL_EDUCATION = 18; // Дошкольное образование
    case PRIMARY_GENERAL_EDUCATION = 19; // Начальное общее образование
    case BASIC_GENERAL_EDUCATION = 20; // Основное общее образование
    case SECONDARY_GENERAL_EDUCATION = 21; // Среднее общее образование
    case INTERNSHIP_PROGRAM = 22; // Интернатура
    case ADDITIONAL_PREPROFESSIONAL_SPORT_PROGRAM = 23; // Дополнительная предпрофессиональная программа в сфере физической культуры и спорта
    case BASIC_HIGHER_EDUCATION = 24; // Базовое высшее образование
    case SPECIALIZED_HIGHER_EDUCATION = 25; // Специализированное высшее образование

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PREPARATION_OF_QUALIFIED_WORKERS => 'Подготовка квалифицированных рабочих, служащих',
            self::MIDDLE_LEVEL_SPECIALIST_TRAINING => 'Программа подготовки специалистов среднего звена',
            self::BACHELOR => 'Бакалавриат',
            self::MASTER => 'Магистратура',
            self::SPECIALIST => 'Специалитет',
            self::POSTGRADUATE => 'Аспирантура',
            self::ADJUNCTURE => 'Адъюнктура',
            self::RESIDENCY => 'Ординатура',
            self::INTERNSHIP => 'Ассистентура - стажировка',
            self::PROFESSIONAL_TRAINING => 'Профессиональная подготовка по профессиям рабочих, должностям служащих',
            self::RETRAINING => 'Переподготовка рабочих, служащих',
            self::ADVANCED_TRAINING => 'Повышение квалификации рабочих, служащих',
            self::ADDITIONAL_GENERAL_DEVELOPMENT_PROGRAM => 'Дополнительная общеразвивающая программа',
            self::ADDITIONAL_PREPROFESSIONAL_PROGRAM => 'Дополнительная предпрофессиональная программа',
            self::ADDITIONAL_PREPROFESSIONAL_ART_PROGRAM => 'Дополнительная предпрофессиональная программа в сфере искусств',
            self::PROFESSIONAL_ADVANCEMENT => 'Повышение квалификации',
            self::PROFESSIONAL_RETRAINING => 'Профессиональная переподготовка',
            self::PRESCHOOL_EDUCATION => 'Дошкольное образование',
            self::PRIMARY_GENERAL_EDUCATION => 'Начальное общее образование',
            self::BASIC_GENERAL_EDUCATION => 'Основное общее образование',
            self::SECONDARY_GENERAL_EDUCATION => 'Среднее общее образование',
            self::INTERNSHIP_PROGRAM => 'Интернатура',
            self::ADDITIONAL_PREPROFESSIONAL_SPORT_PROGRAM => 'Дополнительная предпрофессиональная программа в сфере физической культуры и спорта',
            self::BASIC_HIGHER_EDUCATION => 'Базовое высшее образование',
            self::SPECIALIZED_HIGHER_EDUCATION => 'Специализированное высшее образование',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PREPARATION_OF_QUALIFIED_WORKERS => 'info',
            self::MIDDLE_LEVEL_SPECIALIST_TRAINING => 'primary',
            self::BACHELOR => 'success',
            self::MASTER => 'success',
            self::SPECIALIST => 'warning',
            self::POSTGRADUATE => 'warning',
            self::ADJUNCTURE => 'secondary',
            self::RESIDENCY => 'secondary',
            self::INTERNSHIP => 'light',
            self::PROFESSIONAL_TRAINING => 'info',
            self::RETRAINING => 'danger',
            self::ADVANCED_TRAINING => 'success',
            self::ADDITIONAL_GENERAL_DEVELOPMENT_PROGRAM => 'info',
            self::ADDITIONAL_PREPROFESSIONAL_PROGRAM => 'info',
            self::ADDITIONAL_PREPROFESSIONAL_ART_PROGRAM => 'info',
            self::PROFESSIONAL_ADVANCEMENT => 'success',
            self::PROFESSIONAL_RETRAINING => 'danger',
            self::PRESCHOOL_EDUCATION => 'success',
            self::PRIMARY_GENERAL_EDUCATION => 'success',
            self::BASIC_GENERAL_EDUCATION => 'success',
            self::SECONDARY_GENERAL_EDUCATION => 'success',
            self::INTERNSHIP_PROGRAM => 'light',
            self::ADDITIONAL_PREPROFESSIONAL_SPORT_PROGRAM => 'info',
            self::BASIC_HIGHER_EDUCATION => 'success',
            self::SPECIALIZED_HIGHER_EDUCATION => 'success',
        };
    }
}