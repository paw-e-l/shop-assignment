<?php
namespace App\EventListener;

use App\Entity\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Notification\ProductNotificationInterface;

class NewProductNotifier
{
    private $notificators;

    public function __construct(iterable $notificators)
    {
        $this->notificators = $notificators;
    }

    public function postPersist(Product $product, LifecycleEventArgs $event): void
    {
        iterator_apply($this->notificators, function (ProductNotificationInterface $notificator) {
            $notificator->send();
        });
    }
}