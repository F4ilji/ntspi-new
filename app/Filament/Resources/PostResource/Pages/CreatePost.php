<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Closure;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\BroadcastMessage;
use PhpParser\Node\Expr\AssignOp\Mod;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
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

        $data['reading_time'] = $this->calculateReadingTime($data['search_data']);





        return $data;
    }

    protected function afterCreate(): void
    {
        $recipient = auth()->user();

        Notification::make()
            ->title('Новость на проверку')
            ->body('Новая запись была создана!')
            ->actions([
                Action::make('view')
                    ->label('Проверить')
                    ->button()
                    ->markAsRead()
                    ->url(PostResource::getUrl('edit', ['record' => $this->record])),

            ])

            ->sendToDatabase($recipient);
    }

    private function calculateReadingTime(string $text): int
    {

        // Calculate the number of words in the text
        $wordCount = str_word_count($text,0,"АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя");




        // Calculate the average reading speed in words per minute
        $wordsPerMinute = 120; // You can adjust this value based on your desired reading speed

        // Calculate the reading time in minutes
        $readingTime = $wordCount / $wordsPerMinute;

        // Round the reading time to the nearest integer
        $readingTime = round($readingTime);


        return $readingTime;
    }

    protected function convertDataToHtml($blocks) {
        $convertedHtml = "";
        foreach ($blocks as $block) {
            switch ($block['type']) {
                case "header":
                    $convertedHtml .= "<h" . $block['data']['level'] . ">" . $block['data']['text'] . "</h" . $block['data']['level'] . ">";
                    break;
                case "embded":
                    $convertedHtml .= "<div><iframe width='560' height='315' src='" . $block['data']['embed'] . "' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe></div>";
                    break;
                case "paragraph":
                    $convertedHtml .= "<p>" . $block['data']['text'] . "</p>";
                    break;
                case "delimiter":
                    $convertedHtml .= "<hr />";
                    break;
                case "image":
                    $convertedHtml .= "<img class='img-fluid' src='" . $block['data']['file']['url'] . "' title='" . $block['data']['caption'] . "' /><br /><em>" . $block['data']['caption'] . "</em>";
                    break;
                case "list":
                    $convertedHtml .= "<ul>";
                    foreach ($block['data']['items'] as $li) {
                        $convertedHtml .= "<li>" . $li . "</li>";
                    }
                    $convertedHtml .= "</ul>";
                    break;
                case "table":
                    $convertedHtml .= "<table>";
                    if ($block['data']['withHeadings']) {
                        $convertedHtml .= "<thead><tr>";
                        foreach ($block['data']['content'][0] as $th) {
                            $convertedHtml .= "<th>" . $th . "</th>";
                        }
                        $convertedHtml .= "</tr></thead>";
                    }
                    $convertedHtml .= "<tbody>";
                    foreach ($block['data']['content'] as $row) {
                        $convertedHtml .= "<tr>";
                        foreach ($row as $td) {
                            $convertedHtml .= "<td>" . $td . "</td>";
                        }
                        $convertedHtml .= "</tr>";
                    }
                    $convertedHtml .= "</tbody></table>";
                    break;
                default:
                    echo "Unknown block type " . $block['type'];
                    break;
            }
        }
        return $convertedHtml;
    }


}
