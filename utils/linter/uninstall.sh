#!/bin/bash

CUR_DIR=$(pwd)
if ! test -f ${CUR_DIR}/utils/linter/install.sh; then
    echo "ERROR - You should start install script from root directory of the project"
    exit 1
fi

LINTER_DIR=${CUR_DIR}/utils/linter
GIT_HOOKS_DIR=${CUR_DIR}/.git/hooks

unlink ${GIT_HOOKS_DIR}/pre-commit

unlink  ${GIT_HOOKS_DIR}/pre-push

