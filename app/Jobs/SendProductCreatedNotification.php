<?php

namespace App\Jobs;

use App\Models\Product;
use App\Notifications\ProductCreatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendProductCreatedNotification implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        $this->product->notify(new ProductCreatedNotification($this->product));
    }
}
