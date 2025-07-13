<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Enums\Status;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Machine\UseContainerRequest;
use App\Http\Resources\Api\Containers\ContainerResource;
use App\Models\Container;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UseContainerController extends BaseController
{
    public function __invoke(UseContainerRequest $request)
    {
        DB::beginTransaction();

        try {
            $id = $request->validated('id');
            $type = $request->validated('type');

            $this->unuseContainer($type);

            $container = $this->useContainer($id, $type);

            DB::commit();
        } catch (ModelNotFoundException) {
            DB::rollBack();

            return $this->errorResponse(
                status: Response::HTTP_NOT_FOUND,
                message: __('Container not found.')
            );
        } catch (Exception) {
            DB::rollBack();

            $status = Response::HTTP_INTERNAL_SERVER_ERROR;

            return $this->errorResponse(
                status: $status,
                message: __('shared.http.' . $status)
            );
        }

        return (new ContainerResource($container))
            ->setMessage(__('shared.common.success'));
    }

    private function unuseContainer(string $type): void
    {
        $container = Container::query()
            ->where('type', $type)
            ->where('status', Status::ACTIVE->value)
            ->first();

        if ($container) {
            $container->status = Status::INACTIVE->value;
            $container->save();
        }
    }

    private function useContainer(int $id, string $type): Container
    {
        $container = Container::query()
            ->where('id', $id)
            ->where('type', $type)
            ->firstOrFail();

        $container->status = Status::ACTIVE->value;
        $container->save();

        return $container;
    }
}
