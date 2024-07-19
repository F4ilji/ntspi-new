<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;


    protected function mutateFormDataBeforeFill(array $data): array
    {
        $result = "";


        foreach ($data['content'] as $block) {
            if ($block['type'] === "paragraph" || $block['type'] === "header") {
                $result .= $block['data']['content'] . " ";
            } elseif ($block['type'] === "list") {
                foreach ($block['data']['items'] as $item) {
                    $result .= $item . " ";
                }
            }

        }
        $pattern = '/<li>(.*?)<\/li>/';
        $output = preg_replace($pattern, '$1 ', $result);
        $output = strip_tags($output);
        $data['search_data'] = strtolower(trim($output));


        return $data;
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
